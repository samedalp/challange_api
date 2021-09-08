<?php

namespace App\Services;

use App\Http\Validations\Validation\DeviceRegisterValidation;
use App\Repository\Repositories\DeviceRepository;
use Illuminate\Http\Response;

class AppServices
{
    private DeviceRepository $deviceRepository;


    public function __construct(DeviceRepository $deviceRepository)
    {
        $this->deviceRepository = $deviceRepository;
    }

    public function registerService($request)
    {

        $validation = app(DeviceRegisterValidation::class)->makeValidate($request->toArray());
        if (!$validation->isValid) {
            return new Response($validation->message->toArray(),500);
        }

        if ($this->deviceRepository->findByAttributes(["uid" => $request->get('uid')])) {
            return new Response("This uid is already registered !", 400);
        }

        $insert = $this->deviceRepository->create([
            "uid" => $request->get('uid'),
            "app_id" => $request->get('app_id'),
            "language" => $request->get('language'),
            "device_system" => $request->get('device_system'),
        ]);

        if ($insert) {
            $client_secret = bin2hex(openssl_random_pseudo_bytes(32));
            $response = [
                "client_token" => $client_secret,
                "register" => 'OK'
            ];
            return new Response($response, 200);
        }

        return new Response("Something went wrong !", 404);
    }
}
