<?php

namespace App\Exceptions;

use Exception;

class RoomDoesNotExistException extends Exception
{
    protected $message = 'No such room exists';
    protected $code = 422;
}
