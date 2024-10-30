<?php

namespace Src\Modules\User\Entities;

use Src\Modules\User\Exceptions\InvalidPasswordException;
use Src\Modules\User\Exceptions\InvalidUserException;

class BankingUser extends AbstractUser
{

    public const REGULAR_USER = 'regular_user';
    public const SELLER_USER = 'seller_user';

    public function __construct($full_name, $email, $doc_number, $phone_number, $password, $balance)
    {

        $this->full_name =  $full_name;
        $this->email = $email;
        $this->doc_number = $doc_number;
        $this->phone_number = $phone_number;
        $this->password = $password;
        $this->balance = $balance;

        $this->validateBankingUser();

        $this->user_type = strlen($this->doc_number) == 11 ? self::REGULAR_USER : self::SELLER_USER;

        $this->validatePassword();
    }

    public function __set($name, $value)
    {

        if ($name === 'id') {
            $this->id = $value;
            return;
        }
    }

    private function validateBankingUser()
    {

        if (empty($this->full_name)) {
            throw new InvalidUserException("Full name cannot be empty.");
        }

        if (empty($this->email)) {
            throw new InvalidUserException("Email cannot be empty.");
        }

        if (empty($this->phone_number)) {
            throw new InvalidUserException("Phone number cannot be empty.");
        }

        if (empty($this->doc_number)) {
            throw new InvalidUserException("Document number cannot be empty.");
        }

        if (empty($this->password)) {
            throw new InvalidUserException("Password cannot be empty.");
        }

        if (strlen($this->doc_number) != 11 && strlen($this->doc_number) != 14) {
            throw new InvalidUserException("Document number must be either 11 or 14 characters long.");
        }
    }

    private function validatePassword()
    {

        $minLength = 6;
        $hasUppercase = preg_match('@[A-Z]@', $this->password);
        $hasLowercase = preg_match('@[a-z]@', $this->password);
        $hasNumber = preg_match('@[0-9]@', $this->password);
        $hasSpecialChar = preg_match('@[^\w]@', $this->password);

        // Verifica todos os requisitos
        if (strlen($this->password) < $minLength) {
            throw new InvalidPasswordException('must be at least ' . $minLength . ' characters long.');
        }
        if (!$hasUppercase) {
            throw new InvalidPasswordException('Password must contain at least one uppercase letter.');
        }
        if (!$hasLowercase) {
            throw new InvalidPasswordException('Password must contain at least one lowercase letter.');
        }
        if (!$hasNumber) {
            throw new InvalidPasswordException('Password must contain at least one digit.');
        }
        if (!$hasSpecialChar) {
            throw new InvalidPasswordException('Password must contain at least one special character.');
        }
    }
}
