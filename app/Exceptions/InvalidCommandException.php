<?php

namespace App\Exceptions;

use Exception;

class InvalidCommandException extends Exception
{
    protected $message = 'Invalid user command';
    protected $code = 422;
}
