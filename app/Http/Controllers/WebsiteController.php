<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Http\Request;
use App\Services\AIContentService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class WebsiteController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | List Websites (Pagination)
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        try {

            Log::info('Fetching websites', [
                'user_id' => auth()->id()
            ]);

            $websites = Website::where('user_id', auth()->id())
                ->latest()
                ->paginate(10);

            return $this->successResponse('Websites fetched successfully', $websites);
        } catch (\Exception $e) {
            Log::error('Error fetching websites', [
                'user_id' => auth()->id(),
                'error' => $e->getMessage()
            ]);

            return $this->errorResponse('Failed to fetch websites');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Store + Generate Website (AI Logic)
    |--------------------------------------------------------------------------
    */
    public function store(Request $request, AIContentService $ai)
    {
        try {
            $count = Website::where('user_id', auth()->id())
                ->whereDate('created_at', Carbon::today())
                ->count();

            if ($count >= 5) {
                return response()->json([
                    'status' => false,
                    'message' => 'Daily limit reached (5 per day)'
                ], 429);
            }
            Log::info('Website generation started', [
                'user_id' => auth()->id(),
                'input' => $request->all()
            ]);

            $validated = $this->validateRequest($request);

            $generated = $ai->generate($validated);

            $website = Website::create([
                'user_id' => auth()->id(),
                ...$validated,
                ...$generated,
            ]);

            Log::info('Website generated successfully', [
                'user_id' => auth()->id(),
                'website_id' => $website->id
            ]);

            return $this->successResponse('Website generated successfully', $website);
        } catch (\Exception $e) {
            Log::error('Website generation failed', [
                'user_id' => auth()->id(),
                'error' => $e->getMessage()
            ]);

            return $this->errorResponse('Failed to generate website');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Show Single Website
    |--------------------------------------------------------------------------
    */
    public function show(Website $website)
    {
        try {
            $this->authorizeUser($website);

            Log::info('Fetching single website', [
                'user_id' => auth()->id(),
                'website_id' => $website->id
            ]);

            return $this->successResponse('Website fetched successfully', $website);
        } catch (\Exception $e) {
            Log::error('Error fetching website', [
                'user_id' => auth()->id(),
                'website_id' => $website->id ?? null,
                'error' => $e->getMessage()
            ]);

            return $this->errorResponse('Failed to fetch website');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Update Website
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, Website $website)
    {
        try {
            $this->authorizeUser($website);

            Log::info('Updating website', [
                'user_id' => auth()->id(),
                'website_id' => $website->id
            ]);

            $validated = $this->validateRequest($request);

            $website->update($validated);

            return $this->successResponse('Website updated successfully', $website);
        } catch (\Exception $e) {
            Log::error('Error updating website', [
                'user_id' => auth()->id(),
                'website_id' => $website->id ?? null,
                'error' => $e->getMessage()
            ]);

            return $this->errorResponse('Failed to update website');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Delete Website
    |--------------------------------------------------------------------------
    */
    public function destroy(Website $website)
    {
        try {
            $this->authorizeUser($website);

            Log::info('Deleting website', [
                'user_id' => auth()->id(),
                'website_id' => $website->id
            ]);

            $website->delete();

            return $this->successResponse('Website deleted successfully');
        } catch (\Exception $e) {
            Log::error('Error deleting website', [
                'user_id' => auth()->id(),
                'website_id' => $website->id ?? null,
                'error' => $e->getMessage()
            ]);

            return $this->errorResponse('Failed to delete website');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Reusable Validation
    |--------------------------------------------------------------------------
    */
    private function validateRequest(Request $request)
    {
        return $request->validate([
            'business_name' => 'required|string|max:255',
            'business_type' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Authorization Check
    |--------------------------------------------------------------------------
    */
    private function authorizeUser(Website $website)
    {
        if ($website->user_id !== auth()->id()) {
            Log::warning('Unauthorized access attempt', [
                'user_id' => auth()->id(),
                'website_id' => $website->id
            ]);

            abort(403, 'Unauthorized');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Standard API Response
    |--------------------------------------------------------------------------
    */
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
}
