<?php

namespace  Src\Modules\User\Services;

use Src\Modules\User\Repositories\UserRepository;
use Src\Modules\User\Entities\BankingUser;
use Illuminate\Http\Request;
use Src\Modules\User\Helpers\BodyHelper;

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

            $isAValidRequest = BodyHelper::validadateBodyCreateUser($body = json_decode($request->getContent()));

            if (!$isAValidRequest->valid) {
                return response()->json($isAValidRequest, 400);
            }

            $user = new BankingUser(
                $body->full_name,
                $body->email,
                $body->doc_number,
                $body->phone_number,
                $body->password
            );

            $userDocumentExists = $this->userRepository->findByDocument($user->doc_number);

            if ($userDocumentExists) {
            }

            $userEmailExists = $this->userRepository->findByEmail($user->doc_number);
            if ($userEmailExists) {
            }

            $createdUserId = $this->userRepository->add($user);
        } catch (\Exception $e) {
            return response()->json(['error_msg' => $e->getMessage()], 500);
        }
    }
}
