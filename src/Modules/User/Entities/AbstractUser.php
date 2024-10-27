<?php

namespace Src\Modules\User\Entities;

abstract class AbstractUser
{

    public string $full_name;
    public string $email;
    public string $doc_number;
    public string $phone_number;
    public string $password;
    public string $user_type;
    public float $balance;
}
