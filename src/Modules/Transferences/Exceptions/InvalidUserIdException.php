<?php

namespace Src\Modules\Transferences\Exceptions;

use Exception;

class InvalidUserIdException extends Exception
{

    public function __construct($message)
    {

        parent::__construct($message);
    }
}
