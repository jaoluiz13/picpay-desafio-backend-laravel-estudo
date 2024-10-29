<?php

namespace Src\Modules\User\Repositories\Interfaces;

use Src\Modules\User\Entities\BankingUser;

interface UserRepositoryInterface
{
    public function add(BankingUser $user): int;
    public function findByDocument(string $document): BankingUser | null;
    public function findByEmail(string $email): BankingUser | null;
    public function findById(int $id): BankingUser | null;
}
