<?php

namespace Src\Providers\Notification;


use Src\Modules\User\Entities\BankingUser;
use Src\Modules\Transferences\Entities\Transference;
use Illuminate\Support\Facades\Log;
use Src\Providers\Request\RequestService;


class NotificationService
{
    public function sendNotification(BankingUser $user, Transference $transference)
    {
        try {

            $response = RequestService::request(env('API_DEVTOOLS_URL'), '/v1/notify', 'POST', []);
            if ($response['status'] != "error") {
                Log::info($user->full_name . " received a transfer of $ " . $transference->amount);
                return;
            }

            Log::info('Erro while sending transfer notification');
            return;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
