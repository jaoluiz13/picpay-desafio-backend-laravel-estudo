<?php

namespace Src\Modules\Transferences\Helpers;

class IncommingRequestBodyValidator
{

    public static function validadateBodyTransference(object $body): object
    {
        if (!isset($body->value)) {
            return (object) ['valid' => false, 'message' => 'A value must be provided'];
        }
        if (!isset($body->payer)) {
            return (object) ['valid' => false, 'message' => 'A payer id must be provided'];
        }
        if (!isset($body->payee)) {
            return (object) ['valid' => false, 'message' => ' A payee id must be provided'];
        }

        return (object)['valid' => true, 'message' => 'Valid request parameters'];
    }
}
