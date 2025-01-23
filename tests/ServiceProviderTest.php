<?php

namespace mawadhy\ApplicationInsights\Tests;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Insights;
use mawadhy\ApplicationInsights\ServiceProvider;

class ServiceProviderTest extends TestCase
{

    /**
     * Check that is loaded correctly by laravel
     * @return void
     */
    public function test_that_it_loads_correctly()
    {
        $this->app['config']->set(ServiceProvider::DISPLAY_NAME . '.instrumentation_key', 'notarealinstrumentationkey');

        $insights = $this->app['insights'];
        $this->assertTrue($insights->isEnabled());

        $this->assertInstanceOf(\mawadhy\ApplicationInsights\ApplicationInsights::class, $insights);

    }

    /**
     * Check that is disabled if configuration is set
     * @return void
     */
    public function test_that_it_is_disabled_if_set_in_configuration()
    {
        $this->app['config']->set(ServiceProvider::DISPLAY_NAME . '.instrumentation_key', 'notarealinstrumentationkey');
        $this->app['config']->set(ServiceProvider::DISPLAY_NAME . '.is_enabled', false);

        $insights = $this->app['insights'];
        $this->assertFalse($insights->isEnabled());

        $this->assertInstanceOf(\mawadhy\ApplicationInsights\ApplicationInsights::class, $insights);

    }

    /**
     * Check that it tries to send data
     * This test will throw an exception because the instrumentation key it's not correct
     * @return void
     */
    public function test_that_it_tries_to_send_data()
    {
        $this->app['config']->set(ServiceProvider::DISPLAY_NAME . '.instrumentation_key', 'notarealinstrumentationkey');

        $this->assertInstanceOf(\mawadhy\ApplicationInsights\ApplicationInsights::class, $this->app['insights']);
        $this->assertTrue(Insights::isEnabled());

        $this->expectException(ClientException::class);
        Insights::shouldThrowExceptions(true);

        Insights::trackRequest(new Request(), new Response());

    }

}