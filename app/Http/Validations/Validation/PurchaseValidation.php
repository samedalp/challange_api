<?php


namespace App\Http\Validations\Validation;


use App\Http\Validations\Validation;
use App\Http\Validations\ValidationInterface;
use Illuminate\Support\Facades\Validator;


class PurchaseValidation extends Validation implements ValidationInterface
{

    /**
     * @param array $requestData
     * @return PurchaseValidation
     */
    public function makeValidate(array $requestData): PurchaseValidation
    {
        $validator = Validator::make($requestData, [
            'receipt' => 'string|required',
            'client_token' => 'string|required'
        ]);

        if ($validator->fails()) {
            $this->message = $validator->messages();
            $this->isValid = false;
        }

        return $this;
    }

}
