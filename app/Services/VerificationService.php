<?php

namespace App\Services;

use App\Http\Validations\Validation\DeviceRegisterValidation;
use App\Repository\Repositories\DeviceRepository;
use Carbon\Carbon;
use Illuminate\Http\Response;

class VerificationService
{
    public function isVerifiedToken($receipt): Response
    {
        if (isset($receipt) && $this->verify($receipt)->isSuccessful()) {
            return new Response(true, 204);
        }
        return new Response(false, 405);

    }

    private function verify($receipt): Response
    {
        if ((int)substr($receipt, -1) % 2 != 0) {
            $expire_date = Carbon::now('UTC');
            return new Response(["status" => true, "expire_date" => $expire_date], 200);
        }

        return new Response(["status" => false, "expire_date" => null],405);
    }

}

