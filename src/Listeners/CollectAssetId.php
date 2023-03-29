<?php

namespace Alps\AssetCollector\Listeners;

use Alps\AssetCollector\Collector;
use Alps\AssetCollector\Events\AssetUrlRequested;

class CollectAssetId
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(private Collector $collector)
    {
    }

    public function handle(AssetUrlRequested $event)
    {
        $this->collector->addId($event->id);
    }
}
