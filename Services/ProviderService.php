<?php

namespace App\Services;

use App\Http\Requests\StoreproviderRequest;
use App\Http\Requests\UpdateproviderRequest;
use App\Models\Provider;


class ProviderService
{
    public function showAllProvider(){
        $providers = Provider::all();
        if ($providers->isEmpty()) 
        {
            return response()->json([
                'message' => 'Không có nhà cung cấp nào.',
            ], 404);
        }
        return response()->json([
            'providers' => $providers
        ], 200);
    }
    public  function createProvider(StoreproviderRequest $request)
    {
        $validatedData = $request->validated();
        try {
            $provider = Provider::create($validatedData);
            return response()->json([
                'message' => 'Nhà cung cấp đã được tạo thành công!',
                'provider' => $provider
            ], 201);
    
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Đã xảy ra lỗi trong quá trình tạo nhà cung cấp.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public  function showProvider(Provider $provider){
        if (!$provider) {
            return response()->json([
                'message' => 'Nhà cung cấp không tìm thấy.',
            ], 404);
        }
    
        try {
            return response()->json([
                'provider' => $provider
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Đã xảy ra lỗi trong quá trình lấy thông tin nhà cung cấp.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function updateProvider(UpdateproviderRequest $request, Provider $provider){
        $validatedData = $request->validated();
        try {
            $provider->update($validatedData);
            return response()->json([
                'message' => 'Nhà cung cấp đã được cập nhật thành công!',
                'provider' => $provider
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'message' => 'Đã xảy ra lỗi trong quá trình cập nhật nhà cung cấp.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function deleteProvider(Provider $provider)  {
        try {
            $provider->delete();
            return response()->json([
                'message' => 'Nhà cung cấp đã được xóa thành công!'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Đã xảy ra lỗi trong quá trình xóa nhà cung cấp.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
}
