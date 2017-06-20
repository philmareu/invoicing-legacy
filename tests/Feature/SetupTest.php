<?php

namespace Tests\Feature;

use Illuminate\Database\Eloquent\Collection;
use Invoicing\Models\Setting;
use Invoicing\Models\User;
use Tests\BrowserKitTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SetupTest extends BrowserKitTestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        /**
         * This disables the exception handling to display the stacktrace on the console
         * the same way as it shown on the browser
         */
        parent::setUp();
        $this->disableExceptionHandling();
    }

    /**
     * @group setup
     */
    public function testRedirectToSetupPageIfNoUserExists()
    {
        $this->visit('/')
            ->seePageIs('setup');
    }

    /**
     * @group setup
     */
    public function testSetupFirstUser()
    {
        $this->visit('setup')
            ->type('Admin', 'name')
            ->type('admin@admin.com', 'email')
            ->type('password', 'password')
            ->press('Save')
            ->seePageIs('dashboard');

        $user = $this->getFirstUser();

        $this->assertEquals('User', $user->name);
        $this->assertEquals('user@user.com', $user->email);
        $this->assertTrue(password_verify('password', $user->password));
    }

    /**
     * @group setup
     */
    public function testRedirectIfUserAlreadySet()
    {
        $this->createUser();

        $response = $this->call('GET', 'setup');
        
        $this->assertTrue($response->isRedirect('http://localhost'));
    }

    private function getFirstUser() : User
    {
        $admin = User::find(1);
    }
}
