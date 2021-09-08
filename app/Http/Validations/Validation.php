<?php


namespace App\Http\Validations;

use App\Logger\LoggerInterface;
use Illuminate\Support\MessageBag;

/**
 * Class Validation
 * @package App\Http\Validations
 */
abstract class Validation
{
    /**
     * @var bool
     */
    public bool $isValid;

    /**
     * @var MessageBag
     */
    public MessageBag $message;

    /**
     * Validation constructor.
     */
    public function __construct()
    {
        $this->isValid = true;
    }


}
