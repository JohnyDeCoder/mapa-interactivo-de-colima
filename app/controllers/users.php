<?php

namespace Controllers;
use Models\User;

class Users
{
    public static function create_user($name)
    {
        $user = User::create([
            'name' => $name
        ]);
        return $user;
    }
}