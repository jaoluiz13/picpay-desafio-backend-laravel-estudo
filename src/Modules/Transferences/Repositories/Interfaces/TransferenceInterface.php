<?php

namespace Src\Modules\Transferences\Repositories\Interfaces;

use Src\Modules\Transferences\Entities\Transference;

interface TransferencesRepositoryInterface
{
    public function transfer(Transference $transferenceData): int;
}
