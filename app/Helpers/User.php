<?php

namespace App\Helpers;

class User
{
    public static function authUser()
    {
        return session()->get('user');
    }
}
