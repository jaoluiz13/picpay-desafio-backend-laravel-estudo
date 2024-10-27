<?php

namespace Src\Modules\User\Exceptions;

use Exception;

class InvalidPasswordException extends Exception
{

    public function __construct($message)
    {

        parent::__construct($message);
    }
}
