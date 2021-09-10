<?php

namespace App\Services;

use App\Http\Validations\Validation\DeviceRegisterValidation;
use App\Http\Validations\Validation\PurchaseValidation;
use App\Presenter\ApiCallPresenter;
use App\Repository\Repositories\DeviceRepository;
use App\Repository\Repositories\PurchaseRepository;
use http\Env\Request;
use Illuminate\Http\Response;

class AppServices
{
    use ApiCallPresenter;

    private DeviceRepository $deviceRepository;


    public function __construct(DeviceRepository $deviceRepository)
    {
        $this->deviceRepository = $deviceRepository;
    }

    public function registerService($request)
    {

        $validation = app(DeviceRegisterValidation::class)->makeValidate($request->toArray());
        if (!$validation->isValid) {
            return new Response($validation->message->toArray(), 500);
        }

        if ($this->deviceRepository->findByAttributes(["uid" => $request->get('uid'), "app_id" => $request->get('app_id')])) {
            return new Response("This uid is already registered !", 400);
        }
        $client_secret = bin2hex(openssl_random_pseudo_bytes(32));

        $insert = $this->deviceRepository->create([
            "uid" => $request->get('uid'),
            "app_id" => $request->get('app_id'),
            "language" => $request->get('language'),
            "device_system" => $request->get('device_system'),
            "client_token" => $client_secret
        ]);

        if ($insert) {
            $response = [
                "client_token" => $client_secret,
                "register" => 'OK'
            ];
            return new Response($response, 200);
        }

        return new Response("Something went wrong !", 404);
    }

    public function purchase($request)
    {
        $validation = app(PurchaseValidation::class)->makeValidate($request->toArray());
        if (!$validation->isValid) {
            return new Response($validation->message->toArray(), 500);
        }

        $response = app(VerificationService::class)->isVerifiedToken($request->get('receipt'));
        if ($response->isSuccessful()) {
            $insert = app(PurchaseRepository::class)->create([
                "receipt" => $request->get('receipt'),
                "client_token" => $request->get('client_token'),
                "payment_status" => 1,
            ]);

            if ($insert) {
                return new Response('Payment Successfully Completed', 200);
            }
        }

        return new Response('Payment Failed', 500);

    }

    public function checkSubscription($request)
    {
        if (!empty($request->get('client_token')) && $this->deviceRepository->findByAttributes(["client_token" => $request->get('client_token')])) {
            return new Response('OK', 200);
        }

        return new Response('Failed', 404);

    }
}

