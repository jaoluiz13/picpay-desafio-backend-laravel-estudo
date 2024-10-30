<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use Src\Modules\Transferences\Entities\Transference;
use Src\Modules\Transferences\Exceptions\SelfTransferenceException;
use Src\Modules\Transferences\Exceptions\InvalidTransferValueException;
use Src\Modules\Transferences\Exceptions\InvalidUserIdException;

class TransferTest extends TestCase
{

    private int $id_payer = 1;
    private int $id_payee = 2;
    private float $value = 3.00;

    /** @test */
    public function create_transfer(): void
    {

        $transfer = new Transference($this->id_payee, $this->id_payer, $this->value, date('Y-m-d H:i:s'));

        $this->assertEquals($this->id_payee, $transfer->id_payee);
        $this->assertEquals($this->id_payer, $transfer->id_payer);
        $this->assertEquals($this->value, $transfer->amount);
    }

    /** @test */
    public function create_self_transfer(): void
    {

        $this->id_payee = 1;
        $this->id_payer = 1;

        $this->expectException(SelfTransferenceException::class);
        $this->expectExceptionMessage('You cannot make a transference to yourself.');

        new Transference($this->id_payee, $this->id_payer, $this->value, date('Y-m-d H:i:s'));
    }

    /** @test */
    public function create_transfer_with_invalid_payer_id(): void
    {

        $this->id_payer = 0;
        $this->id_payee = 1;

        $this->expectException(InvalidUserIdException::class);
        $this->expectExceptionMessage('Invalid user id.');

        new Transference($this->id_payee, $this->id_payer, $this->value, date('Y-m-d H:i:s'));
    }

    /** @test */
    public function create_transfer_with_invalid_payee_id(): void
    {

        $this->id_payee = -1;

        $this->expectException(InvalidUserIdException::class);
        $this->expectExceptionMessage('Invalid user id.');

        new Transference($this->id_payee, $this->id_payer, $this->value, date('Y-m-d H:i:s'));
    }

    /** @test */
    public function create_transfer_with_invalid_value(): void
    {

        $this->id_payee = 1;
        $this->id_payer = 2;
        $this->value = -3.00;

        $this->expectException(InvalidTransferValueException::class);
        $this->expectExceptionMessage('Value must be greater than zero.');

        new Transference($this->id_payee, $this->id_payer, $this->value, date('Y-m-d H:i:s'));
    }
}
