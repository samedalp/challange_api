<?php


namespace App\Http\Validations;

/**
 * Interface ValidationInterface
 */
interface ValidationInterface
{
    /**
     * @param array $requestData
     * @return ValidationInterface
     */
    public function makeValidate(array $requestData): ValidationInterface;

}
