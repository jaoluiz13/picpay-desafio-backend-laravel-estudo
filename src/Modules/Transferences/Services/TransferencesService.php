<?php

namespace  Src\Modules\Transferences\Services;

use Src\Modules\User\Repositories\UserRepository;
use Illuminate\Http\Request;
use Src\Modules\Transferences\Entities\Transference;
use Src\Modules\Transferences\Repositories\TransferencesRepository;
use Src\Modules\User\Entities\BankingUser;
use Src\Modules\Transferences\Helpers\IncommingRequestBodyValidator;
use Src\Modules\Providers\TransferAuthorizer\TransferAuthorizerProvider;
use Src\Modules\Providers\Notification\NotificationService;

class TransferencesService
{
    private $_userRepository;
    private $_transferencesRepository;
    private $_transferAuthorizer;
    private $_notificationService;

    public function __construct(
        UserRepository $userRepository,
        TransferencesRepository $transferencesRepository,
        TransferAuthorizerProvider $transferAuthorizer,
        NotificationService $notificationService
    ) {
        $this->_userRepository = $userRepository;
        $this->_transferAuthorizer = $transferAuthorizer;
        $this->_transferencesRepository = $transferencesRepository;
        $this->_notificationService = $notificationService;
    }

    public function createTransfer(Request $request)
    {

        try {
            $isAValidRequest = IncommingRequestBodyValidator::validadateBodyTransference($body = json_decode($request->getContent()));

            if (!$isAValidRequest->valid) {
                return response()->json($isAValidRequest, 400);
            }

            $transfer = new Transference($body->payee, $body->payer, $body->value, date('Y-m-d H:i:s'));

            $payeeUserExists = $this->_userRepository->findById($transfer->id_payee);
            if ($payeeUserExists == null) {
                return response()->json(['message' => 'Payee user not found'], 400);
            }

            $payerUserExists = $this->_userRepository->findById($transfer->id_payer);
            if ($payerUserExists == null) {
                return response()->json(['message' => 'Payer user not found'], 400);
            }

            if ($payerUserExists->user_type == BankingUser::SELLER_USER) {
                return response()->json(['message' => 'A seller user cannot make transactions'], 400);
            }

            if ($this->_transferAuthorizer->authorizeTransfer($transfer)) {
                return response()->json(['message' => 'Unauthorized transfer'], 400);
            }

            $transfer->__set('id', $this->_transferencesRepository->transfer($transfer));

            $this->_notificationService->sendNotification($payeeUserExists, $transfer);

            return response()->json(['transfer' => $transfer], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
