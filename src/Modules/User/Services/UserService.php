<?php

namespace  Src\Modules\User\Services;

use Src\Modules\User\Repositories\UserRepository;
use Src\Modules\User\Entities\BankingUser;
use Illuminate\Http\Request;
use Src\Modules\User\Helpers\IncommingRequestBodyValidator;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create(Request $request)
    {

        try {

            $isAValidRequest = IncommingRequestBodyValidator::validadateBodyCreateUser($body = json_decode($request->getContent()));

            if (!$isAValidRequest->valid) {
                return response()->json($isAValidRequest, 400);
            }

            $user = new BankingUser(
                $body->full_name,
                $body->email,
                $body->doc_number,
                $body->phone_number,
                $body->password,
                .0
            );

            $userDocumentExists = $this->userRepository->findByDocument($user->doc_number);
            if ($userDocumentExists != null) {
                return response()->json(['message' => 'User Document Already exists'], 400);
            }

            $userEmailExists = $this->userRepository->findByEmail($user->email);
            if ($userEmailExists != null) {
                return response()->json(['message' => 'User Email Already  exists'], 400);
            }

            $user->__set('id', $this->userRepository->add($user));

            return response()->json(['user' => $user], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
