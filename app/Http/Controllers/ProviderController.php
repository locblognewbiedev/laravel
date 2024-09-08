<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProviderRequest;
use App\Http\Requests\UpdateProviderRequest;
use App\Services\ProviderService;

class ProviderController extends Controller
{
    protected $providerService;

    public function __construct(ProviderService $providerService)
    {
        $this->providerService = $providerService;
    }

    public function index()
    {
        return $this->providerService->showAllProvider();
    }

    public function store(StoreProviderRequest $request)
    {
        return $this->providerService->createProvider($request);
    }

    public function show(Provider $provider)
    {
        return $this->providerService->showProvider($provider);
    }

    public function update(UpdateProviderRequest $request, Provider $provider)
    {
        return $this->providerService->updateProvider($request,$provider);
    }

    public function destroy(Provider $provider)
    {
        return $this->providerService->deleteProvider($provider);
    }
}
