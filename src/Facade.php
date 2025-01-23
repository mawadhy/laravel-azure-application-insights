<?php

namespace mawadhy\ApplicationInsights;

use Illuminate\Support\Facades\Facade as LaravelFacade;

/**
 * @see \mawadhy\ApplicationInsights\ApplicationInsights
 */
class Facade extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return 'insights';
    }
}