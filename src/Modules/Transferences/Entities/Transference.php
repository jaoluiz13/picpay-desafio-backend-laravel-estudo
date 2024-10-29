<?php

namespace Src\Modules\Transferences\Entities;

use Src\Modules\Transferences\Exceptions\InvalidTransferValueException;
use Src\Modules\Transferences\Exceptions\InvalidUserIdException;

class Transference
{

    public int $id;
    public int $id_payer;
    public int $id_payee;
    public float $amount;
    public string $created_at;

    public function __construct($id_payee, $id_payer, $amount, $created_at)
    {
        $this->id_payee = $id_payee;
        $this->id_payer = $id_payer;
        $this->amount = $amount;
        $this->created_at = $created_at;

        $this->validate();
    }

    public function validate()
    {
        if ($this->amount <= 0) {
            throw new InvalidTransferValueException('Value must be greater than zero.');
        }

        if ($this->id_payee <= 0 || $this->id_payer <= 0) {
            throw new InvalidUserIdException('Invalid user id.');
        }
    }

    public function __set($name, $value)
    {

        if ($name === 'id') {
            $this->id = $value;
            return;
        }
    }
}
