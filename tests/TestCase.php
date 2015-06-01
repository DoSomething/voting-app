<?php

use Laracasts\Integrated\Extensions\Laravel as IntegrationTest;

class TestCase extends IntegrationTest
{

    /**
     * Migrate database and set up HTTP headers
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        // We'll run all tests through a transaction,
        // and then rollback afterward.
        $this->app['db']->beginTransaction();
    }

    /**
     * Rollback transactions after each test.
     */
    public function tearDown()
    {
        $this->app['db']->rollback();

        parent::tearDown();
    }

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

        return $app;
    }

}
