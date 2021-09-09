<?php

namespace App\Http\Controllers;

use App\Services\AppServices;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AppController extends Controller
{
    private AppServices $appServices;

    /**
     *
     * @param AppServices $appServices
     */

    public function __construct(AppServices $appServices)
    {
        $this->appServices = $appServices;
    }

    public function registerApp(Request $request): Response
    {
        $response = $this->appServices->registerService($request);
        return new Response($response, $response->status());
    }

    public function purchase(Request $request): Response
    {
        $response = $this->appServices->purchase($request);
        return new Response($response, $response->status());
    }

    public function checkSubscription(Request $request): Response
    {
        $response = $this->appServices->checkSubscription($request);
        return new Response($response, $response->status());
    }


}
