<?php


use DoSomething\Gateway\Northstar;

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    protected $baseUrl = 'http://localhost';

    /**
     * Migrate database and set up HTTP headers.
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
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

        return $app;
    }

    /**
     * Mock a class, and register with the IoC container.
     *
     * @param $class String - Class name to mock
     * @return \Mockery\MockInterface
     */
    public function mock($class)
    {
        $mock = Mockery::mock($class);
        $this->app->instance($class, $mock);

        return $mock;
    }

    /**
     * Simulate a given Fastly country code.
     *
     * @param $country_code - Country code
     * @return static
     */
    public function inCountry($country_code)
    {
        $this->withServerVariables(['HTTP_X_FASTLY_COUNTRY_CODE' => $country_code]);

        return $this;
    }

    /**
     * Log out of local session & mock SSO logout request.
     */
    public function logout()
    {
        $northstarMock = $this->mock(Northstar::class);

        // @TODO: Remove this once we no longer need to override grant.
        $northstarMock->shouldReceive('usingGrant')->andReturnSelf();

        $northstarMock->shouldReceive('logout');

        // And log out of the Laravel application (since we're mocking NS method).
        $this->app->auth->logout();
    }
}
