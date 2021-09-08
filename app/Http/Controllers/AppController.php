<?php

namespace App\Http\Controllers;

use App\Services\AppServices;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AppController extends Controller
{
    private AppServices $appServices;

    /**
     * Create a new controller instance.
     *
     * @param AppServices $appServices
     */

    public function __construct(AppServices $appServices)
    {
        $this->appServices = $appServices;
    }


    public function registerApp(Request $request)
    {
        $response = $this->appServices->registerService($request);

        return new Response($response, 200);
    }


}
