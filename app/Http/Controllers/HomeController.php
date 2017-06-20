<?php

namespace Invoicing\Http\Controllers;

use Invoicing\Http\Requests;
use Illuminate\Http\Request;
use Invoicing\Repositories\SetupRepository;

class HomeController extends Controller
{
    /**
     * @var SetupRepository
     */
    protected $setupRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SetupRepository $setupRepository)
    {
        $this->setupRepository = $setupRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($this->setupRequired()) return redirect('setup');

        return redirect('dashboard');
    }

    private function setupRequired()
    {
        return $this->setupRepository->isNotSetup();
    }
}
