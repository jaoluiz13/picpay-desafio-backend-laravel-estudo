<?php

namespace Src\Modules\User\Controllers;

use Src\Modules\User\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    private $_userService;

    public function __construct(UserService $userService)
    {
        $this->_userService = $userService;
    }

    public function handleCreateUserRequest(Request $request)
    {

        return $this->_userService->create($request);
    }
}
