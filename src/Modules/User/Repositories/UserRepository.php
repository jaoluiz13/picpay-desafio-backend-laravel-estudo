<?php

namespace Src\Modules\User\Repositories;

use Illuminate\Support\Facades\DB;
use Src\Modules\User\Entities\BankingUser;
use Src\Modules\User\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    public function add(BankingUser $user): void
    {
        DB::table('users')->insert([
            'full_name' => $user->full_name,
            'email' => $user->full_name,
            'doc_number' => $user->full_name,
            'phone_number' => $user->full_name,
            'password' => password_hash($user->full_name, PASSWORD_BCRYPT),
            'user_type' => $user->full_name,
            'balance' => $user->balance,
        ]);
    }

    public function findByDocument(string $document): BankingUser
    {
        return DB::table('users')->select(['*'])->where('document', $document)->first();
    }
    public function findByEmail(string $email): BankingUser
    {
        return DB::table('users')->select(['*'])->where('email', $email)->first();
    }
}
