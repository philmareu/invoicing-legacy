<?php

namespace Tests\Unit;

use Invoicing\Repositories\SetupRepository;
use Tests\BrowserKitTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SetupRepositoryTest extends BrowserKitTestCase
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
    public function testIsNotSetup()
    {
        $setupRepository = new SetupRepository;
        $settings = $this->getSettings();

        $this->assertEquals(true, $setupRepository->isNotSetup());
    }

    /**
     * @group setup
     */
    public function testIsSetup()
    {
        $this->createUser();

        $setupRepository = new SetupRepository;
        $settings = $this->getSettings();

        $this->assertEquals(true, $setupRepository->isSetup());
    }
}
