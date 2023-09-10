<?php

namespace App\Exceptions;

use RuntimeException;

class ManagerException extends RuntimeException
{
    public function __construct(string $message, $code = 422, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
