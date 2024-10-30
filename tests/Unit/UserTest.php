<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Src\Modules\User\Entities\BankingUser;

use Src\Modules\User\Exceptions\InvalidPasswordException;
use Src\Modules\User\Exceptions\InvalidUserException;


class UserTest extends TestCase
{

    private  string $full_name = 'Test user';
    private string $email = 'test@gmail.com';
    private string $doc_number = '00000000000';
    private string $phone = '32999999999';
    private string $password = 'Test@1234';
    private float $initialBalance = 100;

    /** @test */
    public function create_banking_user(): void
    {

        $user = new BankingUser($this->full_name, $this->email, $this->doc_number, $this->phone, $this->password, $this->initialBalance);

        $this->assertEquals($this->full_name, $user->full_name);
        $this->assertEquals($this->email, $user->email);
        $this->assertEquals($this->phone, $user->phone_number);
        $this->assertEquals($this->initialBalance, $user->balance);
        $this->assertEquals($this->password, $user->password);
    }

    /** @test */
    public function create_banking_user_with_no_name(): void
    {
        $this->expectException(InvalidUserException::class);
        $this->expectExceptionMessage("Full name cannot be empty.");
        $user = new BankingUser('', $this->email, $this->doc_number, $this->phone, $this->password, $this->initialBalance);
    }

    /** @test */
    public function create_banking_user_with_no_email(): void
    {
        $this->expectException(InvalidUserException::class);
        $this->expectExceptionMessage("Email cannot be empty.");
        $user = new BankingUser($this->full_name, '', $this->doc_number, $this->phone, $this->password, $this->initialBalance);
    }

    /** @test */
    public function create_banking_user_with_no_phone(): void
    {
        $this->expectException(InvalidUserException::class);
        $this->expectExceptionMessage("Phone number cannot be empty.");
        $user = new BankingUser($this->full_name, $this->email, $this->doc_number, '', $this->password, $this->initialBalance);
    }

    /** @test */
    public function create_banking_user_with_weak_password(): void
    {

        $this->expectException(InvalidPasswordException::class);
        $user = new BankingUser($this->full_name, $this->email, $this->doc_number, $this->phone, "123456", $this->initialBalance);
    }

    /** @test */
    public function create_banking_user_with_invalid_doc_number(): void
    {
        $this->expectException(InvalidUserException::class);
        $this->expectExceptionMessage("Document number must be either 11 or 14 characters long.");
        $user = new BankingUser($this->full_name, $this->email, '123456789', $this->phone, $this->password, $this->initialBalance);
    }
}
