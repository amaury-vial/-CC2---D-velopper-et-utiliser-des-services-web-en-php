<?php

namespace service;

class UserChecking
{
    public function authenticate($login, $password, $data): bool
    {
        return ($data->getUser($login, $password) != null);
    }

}