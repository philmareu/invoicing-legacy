<?php

namespace Invoicing\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Invoicing\Http\Requests\StoreSetupRequest;
use Invoicing\Repositories\SetupRepository;

class SetupController extends Controller
{
    /**
     * @var SetupRepository
     */
    private $setupRepository;

    public function __construct(SetupRepository $setupRepository)
    {
        $this->setupRepository = $setupRepository;
    }

    public function setup()
    {
        if($this->alreadySetup()) return redirect('/');

        return view('setup.index');
    }

    public function store(StoreSetupRequest $request)
    {
        $user = $this->setupRepository->saveSetup($request->all());
        Auth::login($user);

        return redirect('dashboard');
    }

    private function alreadySetup()
    {
        return $this->setupRepository->isSetup();
    }
}
