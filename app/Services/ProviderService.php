<?php

namespace App\Services;

use App\Models\Provider;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class ProviderService
{
    /**
     * Show all providers.
     *
     * @return JsonResponse
     */
    public function showAllProvider(): JsonResponse
    {
        try {
            $providers = Provider::all();
            return response()->json([
                'providers' => $providers
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve providers.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create a new provider.
     *
     * @param $request
     * @return JsonResponse
     */
    public function createProvider($request): JsonResponse
    {
        try {
            $provider = Provider::create($request->validated());
            return response()->json([
                'message' => 'Nhà cung cấp đã được tạo thành công!',
                'provider' => $provider
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to create provider.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show a specific provider.
     *
     * @param Provider $provider
     * @return JsonResponse
     */
    public function showProvider(Provider $provider): JsonResponse
    {
        try {
            return response()->json([
                'provider' => $provider
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Provider not found.',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve provider.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update a specific provider.
     *
     * @param $request
     * @param Provider $provider
     * @return JsonResponse
     */
    public function updateProvider($request, Provider $provider): JsonResponse
    {
        try {
            $provider->update($request->validated());
            return response()->json([
                'message' => 'Nhà cung cấp đã được cập nhật thành công!',
                'provider' => $provider
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Provider not found.',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to update provider.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete a specific provider.
     *
     * @param Provider $provider
     * @return JsonResponse
     */
    public function deleteProvider(Provider $provider): JsonResponse
    {
        try {
            $provider->delete();
            return response()->json([
                'message' => 'Nhà cung cấp đã được xóa thành công!'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Provider not found.',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to delete provider.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
