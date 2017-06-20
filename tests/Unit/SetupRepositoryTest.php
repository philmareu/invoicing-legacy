<?php

namespace Tests\Unit;

use Invoicing\Models\User;
use Invoicing\Repositories\SetupRepository;
use Tests\BrowserKitTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SetupRepositoryTest extends BrowserKitTestCase
{
    use DatabaseMigrations;

    public function __construct()
    {
        parent::__construct();

        $this->user = new User;
    }

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
    public function testIsNotSetup()
    {
        $setupRepository = new SetupRepository($this->user);
        $settings = $this->getSettings();

        $this->assertEquals(true, $setupRepository->isNotSetup());
    }

    /**
     * @group setup
     */
    public function testIsSetup()
    {
        $this->createUser();

        $setupRepository = new SetupRepository($this->user);
        $settings = $this->getSettings();

        $this->assertEquals(true, $setupRepository->isSetup());
    }

    /**
     * @group setup
     */
    public function testSaveSetup()
    {
        $setupRepository = new SetupRepository($this->user);
        $user = $setupRepository->saveSetup([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt('password')
        ]);

        $this->assertInstanceOf(\Invoicing\Models\User::class, $user);
        $this->assertEquals('User', $user->name);
        $this->assertEquals('user@user.com', $user->email);
        $this->assertTrue(password_verify('password', $user->password));
    }
}
