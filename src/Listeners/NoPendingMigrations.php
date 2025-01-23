<?php

namespace mawadhy\ApplicationInsights\Listeners;

use Illuminate\Database\Events\NoPendingMigrations as NoPendingMigrationsEvent;
use mawadhy\ApplicationInsights\ApplicationInsights;

class NoPendingMigrations
{
    public function __construct(private ApplicationInsights $insights)
    {
    }

    public function handle(NoPendingMigrationsEvent $event)
    {
        $this->insights->trackEvent('Nothing to migrate');
    }
}
