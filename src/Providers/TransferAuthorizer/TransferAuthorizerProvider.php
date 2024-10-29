<?php

namespace Src\Providers\TransferAuthorizer;

use Src\Providers\TransferAuthorizer\Interfaces\TransferAuthorizerProviderInterface;
use Src\Providers\Request\RequestService;
use Src\Modules\Transferences\Entities\Transference;

class TransferAuthorizerProvider implements TransferAuthorizerProviderInterface
{
    public function authorizeTransfer(Transference $transference): bool
    {
        try {

            $response = RequestService::request(env('API_DEVTOOLS_URL'), '/v2/authorize ', 'GET', []);
            return $response['data']['authorization'];
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
