<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Http\Request;
use App\Services\AIContentService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class WebsiteController extends Controller
{
    public function index()
    {
        try {
            $websites = Website::where('user_id', auth()->id())
                ->latest()
                ->paginate(10);

            return $this->successResponse('Websites fetched successfully', $websites);
        } catch (\Exception $e) {
            Log::error('Error fetching websites', ['error' => $e->getMessage()]);
            return $this->errorResponse('Failed to fetch websites');
        }
    }

    public function store(Request $request, AIContentService $ai)
    {
        try {
            $validated = $this->validateRequest($request);

            //  Rate limiting (always count DB)
            $count = Website::where('user_id', auth()->id())
                ->whereDate('created_at', Carbon::today())
                ->count();

            if ($count >= 5) {
                return response()->json([
                    'status' => false,
                    'message' => 'Daily limit reached (5 per day)'
                ], 429);
            }

            //  Generate cache key
            $cacheKey = $this->getCacheKey($validated);

            // Always generate OR fetch content (no DB bypass)
            if (Cache::has($cacheKey)) {
                $generated = Cache::get($cacheKey);
                Log::info('Using cached AI content');
            } else {
                $generated = $ai->generate($validated);

                // Store ONLY generated content
                Cache::put($cacheKey, $generated, now()->addMinutes(10));
                Log::info('Generated new AI content');
            }

            //  ALWAYS create DB record (important fix)
            $website = Website::create([
                'user_id' => auth()->id(),
                ...$validated,
                ...$generated,
            ]);

            return $this->successResponse(
                Cache::has($cacheKey) ? 'Website generated from cache' : 'Website generated successfully',
                $website
            );
        } catch (\Exception $e) {
            Log::error('Store error', ['error' => $e->getMessage()]);
            return $this->errorResponse('Failed to generate website');
        }
    }

    public function show($id)
    {
        try {
            $website = Website::find($id);

            if (!$website) {
                return response()->json([
                    'status' => false,
                    'message' => 'Website not found'
                ], 404);
            }

            $this->authorizeUser($website);

            return $this->successResponse('Website fetched successfully', $website);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch website');
        }
    }

    public function update(Request $request, Website $website, AIContentService $ai)
    {
        try {
            Log::info($request->all());
            
            $this->authorizeUser($website);

            Log::info('Update request received', ['website_id' => $website->id, 'user_id' => auth()->id()]);

            // Validate input
            $validated = $request->validate([
                'business_name' => 'required|string|max:255',
                'business_type' => 'required|string|max:255',
                'description' => 'required|string',

                // Optional manual fields
                'title' => 'nullable|string',
                'tagline' => 'nullable|string',
                'about' => 'nullable|string',
                'services' => 'nullable|array',

                'mode' => 'nullable|in:auto,manual'
            ]);

            $mode = $validated['mode'] ?? 'auto';

            // Detect if core fields changed
            $isChanged =
                $website->business_name !== $validated['business_name'] ||
                $website->business_type !== $validated['business_type'] ||
                $website->description !== $validated['description'];

            // Remove OLD cache
            $oldCacheKey = $this->getCacheKey([
                'business_name' => $website->business_name,
                'business_type' => $website->business_type,
                'description' => $website->description,
            ]);

            Cache::forget($oldCacheKey);

            // ============================
            //  MANUAL MODE
            // ============================
            if ($mode === 'manual') {

                $website->update([
                    'business_name' => $validated['business_name'],
                    'business_type' => $validated['business_type'],
                    'description' => $validated['description'],

                    'title' => $validated['title'] ?? $website->title,
                    'tagline' => $validated['tagline'] ?? $website->tagline,
                    'about' => $validated['about'] ?? $website->about,
                    'services' => $validated['services'] ?? $website->services,
                ]);

                return $this->successResponse('Website updated manually', $website);
            }

            // ============================
            //  AUTO MODE (DEFAULT)
            // ============================
            if ($isChanged) {

                $cacheKey = $this->getCacheKey([
                    'business_name' => $validated['business_name'],
                    'business_type' => $validated['business_type'],
                    'description' => $validated['description'],
                ]);

                if (Cache::has($cacheKey)) {
                    $generated = Cache::get($cacheKey);
                    Log::info('Using cached AI content (update)');
                } else {
                    $generated = $ai->generate($validated);
                    Cache::put($cacheKey, $generated, now()->addMinutes(10));
                    Log::info('Generated new AI content (update)');
                }

                $website->update([
                    ...$validated,
                    ...$generated
                ]);

                return $this->successResponse('Website updated with regenerated AI content', $website);
            }

            // ============================
            //  NO CHANGE
            // ============================
            $website->update($validated);

            return $this->successResponse('Website updated (no major changes)', $website);
        } catch (\Exception $e) {
            Log::error('Update error', ['error' => $e->getMessage()]);
            return $this->errorResponse('Failed to update website');
        }
    }

    public function destroy(Website $website)
    {
        try {
            $this->authorizeUser($website);

            //  Remove cache
            $cacheKey = $this->getCacheKey([
                'business_name' => $website->business_name,
                'business_type' => $website->business_type,
                'description' => $website->description,
            ]);

            Cache::forget($cacheKey);

            $website->delete();

            return $this->successResponse('Website deleted successfully');
        } catch (\Exception $e) {
            Log::error('Delete error', ['error' => $e->getMessage()]);
            return $this->errorResponse('Failed to delete website');
        }
    }

    private function validateRequest(Request $request)
    {
        return $request->validate([
            'business_name' => 'required|string|max:255',
            'business_type' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    }

    private function authorizeUser(Website $website)
    {
        if ($website->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
    }

    private function successResponse($message, $data = null)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ]);
    }

    private function errorResponse($message)
    {
        return response()->json([
            'status' => false,
            'message' => $message
        ], 500);
    }

    //  Safe cache key
    private function getCacheKey($data)
    {
        ksort($data); // prevent key mismatch
        return 'user_' . auth()->id() . '_website_' . md5(json_encode($data));
    }
}
