<?php

namespace Src\Modules\Providers\TransferAuthorizer;

use Src\Modules\Providers\TransferAuthorizer\Interfaces\TransferAuthorizerProviderInterace;
use Src\Modules\Transferences\Entities\Transference;
use Src\Modules\Providers\Request\RequestService;

class TransferAuthorizerProvider implements TransferAuthorizerProviderInterace
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
