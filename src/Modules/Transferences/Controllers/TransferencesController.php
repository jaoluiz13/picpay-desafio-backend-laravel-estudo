<?php

namespace Src\Modules\Transferences\Controllers;

use Src\Modules\Transferences\Services\TransferencesService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransferencesController extends Controller
{
    private $_transferencesService;

    public function __construct(TransferencesService $transferencesService)
    {
        $this->_transferencesService = $transferencesService;
    }

    public function handleCreateTransferRequest(Request $request)
    {

        return $this->_transferencesService->createTransfer($request);
    }
}
