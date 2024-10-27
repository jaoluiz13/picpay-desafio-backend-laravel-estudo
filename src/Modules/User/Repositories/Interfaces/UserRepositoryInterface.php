<?php

namespace Src\Modules\User\Repositories\Interfaces;

use Src\Modules\User\Entities\BankingUser;

interface UserRepositoryInterface
{
    public function add(BankingUser $user): void;
    public function findByDocument(string $document): BankingUser;
    public function findByEmail(string $email): BankingUser;
}
