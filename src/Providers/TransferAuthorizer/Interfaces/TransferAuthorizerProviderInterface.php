<?php

namespace Src\Providers\TransferAuthorizer\Interfaces;

use Src\Modules\Transferences\Entities\Transference;

interface TransferAuthorizerProviderInterface
{
    public function authorizeTransfer(Transference $transference): bool;
}
