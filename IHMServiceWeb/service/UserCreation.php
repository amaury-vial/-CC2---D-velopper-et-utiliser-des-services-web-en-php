<?php

namespace service;

class UserCreation
{
    public function createUser($login, $password, $name, $firstName, $data): bool
    {
        return ($data->createUser($login, $password, $name, $firstName) != false );
    }
}