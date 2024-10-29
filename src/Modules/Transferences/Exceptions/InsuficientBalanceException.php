<?php

namespace Src\Modules\Transferences\Exceptions;

use Exception;

class InsuficienteBalanceException extends Exception
{

    public function __construct($message)
    {

        parent::__construct($message);
    }
}
