<?php

namespace Src\Providers\TransferAuthorizer\Interfaces;

use Src\Modules\Transferences\Entities\Transference;

interface TransferAuthorizerProviderInterace
{
    public function authorizeTransfer(Transference $transference): bool;
}
