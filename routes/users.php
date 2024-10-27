<?php

use Illuminate\Support\Facades\Route;

use Src\Modules\User\Controllers\UserController;

Route::post('/user/create', [UserController::class, 'handleCreateUserRequest']);
