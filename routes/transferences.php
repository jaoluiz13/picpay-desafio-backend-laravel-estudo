<?php

use Illuminate\Support\Facades\Route;

use Src\Modules\Transferences\Controllers\TransferencesController;

Route::post('/transfer', [TransferencesController::class, 'handleCreateTransferRequest']);
