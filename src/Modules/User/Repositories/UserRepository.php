<?php

namespace Src\Modules\User\Repositories;

use Illuminate\Support\Facades\DB;
use Src\Modules\User\Entities\BankingUser;
use Src\Modules\User\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    public function add(BankingUser $user): int
    {
        return DB::table('users')->insertGetId([
            'full_name' => $user->full_name,
            'email' => $user->email,
            'doc_number' => $user->doc_number,
            'phone_number' => $user->phone_number,
            'password' => password_hash($user->password, PASSWORD_BCRYPT),
            'user_type' => $user->user_type,
            'balance' => $user->balance,
        ]);
    }

    public function findByDocument(string $document): BankingUser | null
    {
        $user =  DB::table('users')->select(['*'])->where('doc_number', $document)->first();
        return $user == null ? null : new BankingUser($user->full_name, $user->email, $user->doc_number, $user->phone_number, $user->password, $user->balance);
    }
    public function findByEmail(string $email): BankingUser | null
    {
        $user = DB::table('users')->select(['*'])->where('email', $email)->first();
        return $user == null ? null : new BankingUser($user->full_name, $user->email, $user->doc_number, $user->phone_number, $user->password, $user->balance);
    }
}
