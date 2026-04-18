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

    public function show(Website $website)
    {
        try {
            $this->authorizeUser($website);

            return $this->successResponse('Website fetched successfully', $website);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch website');
        }
    }

    public function update(Request $request, Website $website)
    {
        try {
            $this->authorizeUser($website);

            $validated = $this->validateRequest($request);

            //  Remove old cache
            $oldKey = $this->getCacheKey([
                'business_name' => $website->business_name,
                'business_type' => $website->business_type,
                'description' => $website->description,
            ]);

            Cache::forget($oldKey);

            $website->update($validated);

            return $this->successResponse('Website updated successfully', $website);
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
