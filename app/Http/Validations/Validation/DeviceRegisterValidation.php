<?php


namespace App\Http\Validations\Validation;


use App\Http\Validations\Validation;
use App\Http\Validations\ValidationInterface;
use Illuminate\Support\Facades\Validator;

/**
 * Class SendInvoiceToApprovalStageValidation
 * @package App\Http\Validations\Validation
 */
class DeviceRegisterValidation extends Validation implements ValidationInterface
{

    /**
     * @param array $requestData
     * @return DeviceRegisterValidation
     */
    public function makeValidate(array $requestData): DeviceRegisterValidation
    {
        $validator = Validator::make($requestData, [
            'uid' => 'string|required',
            'app_id' => 'string|required',
            'language' => 'string|required',
            'device_system' => 'string|required',
        ]);

        if ($validator->fails()) {
            $this->message = $validator->messages();
            $this->isValid = false;
        }

        return $this;
    }

}
