<?php

namespace App\Http\Controllers\Dashboard\Shop;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Provider\ProviderCollection;
use App\Repositories\Api\Shop\V1\ProviderRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProviderController extends Controller
{
    private $providerRepo;
    public function __construct(ProviderRepository $providerRepo)
    {
        $this->providerRepo = $providerRepo;
        $this->providerRepo->setPagination(10);
    }
    public function index()
    {
        $providers = $this->providerRepo->paginate();
        return Inertia::render('Providers/Index', [
            'can' => [
                'create' => true,
                'edit' => true,
                'delete' => false,
            ],
            'resource_name' => 'providers',
            'deletable' => false,
            'providers' => $providers
        ]);
    }
}
