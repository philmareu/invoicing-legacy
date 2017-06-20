<?php

namespace Invoicing\Repositories;


use Invoicing\Models\User;

class SetupRepository
{
    public function isNotSetup()
    {
        $users = User::all();
        return $users->isEmpty();
    }

    public function isSetup()
    {
        return ! $this->isNotSetup();
    }
}