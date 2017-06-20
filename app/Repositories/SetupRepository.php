<?php

namespace Invoicing\Repositories;


use Invoicing\Models\User;

class SetupRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function isNotSetup()
    {
        $users = User::all();
        return $users->isEmpty();
    }

    public function isSetup()
    {
        return ! $this->isNotSetup();
    }

    public function saveSetup($settings)
    {
        return $this->user->create($settings);
    }
}