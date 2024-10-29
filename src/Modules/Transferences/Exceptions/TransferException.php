<?php

namespace Src\Modules\Transferences\Exceptions;

use Exception;

class TransferException extends Exception
{

    public function __construct($message)
    {

        parent::__construct($message);
    }
}
