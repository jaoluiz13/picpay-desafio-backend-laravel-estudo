<?php

namespace Src\Modules\Transferences\Exceptions;

use Exception;

class InvalidUserSendingTransferencesException extends Exception
{

    public function __construct($message)
    {

        parent::__construct($message);
    }
}
