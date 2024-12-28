<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class ServiceException extends Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable|null $previous = null)
    {
        parent::__construct($message);
    }
}
