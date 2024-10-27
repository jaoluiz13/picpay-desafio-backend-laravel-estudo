<?php

namespace Src\Modules\User\Helpers;

class BodyHelper
{

    public static function validadateBodyCreateUser(object $body): object
    {
        if (!isset($body->full_name)) {
            return (object) ['valid' => false, 'message' => 'A full name must be provided'];
        }
        if (!isset($body->email)) {
            return (object) ['valid' => false, 'message' => ' An email address must be provided'];
        }
        if (!isset($body->doc_number)) {
            return (object) ['valid' => false, 'message' => 'A doc number must be provided'];
        }
        if (!isset($body->phone_number)) {
            return (object) ['valid' => false, 'message' => ' A phone number must be provided'];
        }
        if (!isset($body->password)) {
            return (object) ['valid' => false, 'message' => ' A password must be provided'];
        }

        return (object)['valid' => true, 'message' => 'Valid request parameters'];
    }
}
