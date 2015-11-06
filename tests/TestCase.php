<?php

use Laracasts\Integrated\Extensions\Laravel as IntegrationTest;
use Symfony\Component\DomCrawler\Crawler;

class TestCase extends IntegrationTest
{
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
     * Make a request simulated from a given Fastly country code.
     * @see Laracasts\Integrated\Extensions\Traits\LaravelTestCase makeRequest()
     *
     * @param $url - URL to visit
     * @param $country_code - Country code
     * @param string $method - HTTP method (e.g. 'GET', or 'POST')
     * @param null $body - Body of post request
     * @return static
     */
    public function visitFromCountry($url, $country_code, $method = 'GET', $body = null)
    {
        $this->refreshApplication();

        $this->call($method, $url, [], [], [], ['HTTP_X_FASTLY_COUNTRY_CODE' => $country_code], $body);

        $this->clearInputs()->followRedirects()->assertPageLoaded($url);

        $this->currentPage = $this->app['request']->fullUrl();

        $this->crawler = new Crawler($this->response(), $this->currentPage());

        return $this;
    }
}
