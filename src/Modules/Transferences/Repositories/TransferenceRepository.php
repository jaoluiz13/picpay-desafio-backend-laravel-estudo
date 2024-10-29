<?php

namespace Src\Modules\Transferences\Repositories;

use Illuminate\Support\Facades\DB;
use Src\Modules\Transferences\Entities\Transference;
use Src\Modules\Transferences\Repositories\Interfaces\TransferencesRepositoryInterface;
use Src\Modules\Transferences\Exceptions\TransferException;

class TransferencesRepository implements TransferencesRepositoryInterface
{

    public function transfer(Transference $transference): int
    {
        DB::beginTransaction();

        try {

            $sender = DB::table('users')->where('id', $transference->id_payer)->lockForUpdate()->first();
            $receiver = DB::table('users')->where('id', $transference->id_payee)->lockForUpdate()->first();

            if ($sender->balance < $transference->amount) {
                throw new TransferException("Insufficient balance.");
            }

            $sender->balance -= $transference->amount;
            $sender->save();

            $receiver->balance += $transference->amount;
            $receiver->save();

            $transactionId = DB::table('transactions')->insertGetId([
                'sender_id' => $transference->id_payer,
                'receiver_id' => $transference->id_payee,
                'amount' => $transference->amount,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();

            return $transactionId;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new TransferException($e->getMessage());
        }
    }
}
