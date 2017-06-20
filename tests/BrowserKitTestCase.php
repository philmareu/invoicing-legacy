<?php

namespace Tests;

use Exception;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Invoicing\Exceptions\Handler;
use Invoicing\Models\Setting;
use Invoicing\Models\User;
use Laravel\BrowserKitTesting\TestCase as BaseTestCase;

abstract class BrowserKitTestCase extends BaseTestCase
{
    /**
     * The base URL of the application.
     *
     * @var string
     */
    public $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    // Use this version if you're on PHP 7
    protected function disableExceptionHandling()
    {
        $this->app->instance(ExceptionHandler::class, new class extends Handler {
            public function __construct() {}

            public function report(Exception $e)
            {
                // no-op
            }

            public function render($request, Exception $e) {
                throw $e;
            }
        });
    }

    protected function getSettings()
    {
        return Setting::all();
    }

    protected function createUser()
    {
        return factory(User::class)->create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt('password')
        ]);
    }
}