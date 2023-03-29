<?php

namespace Alps\AssetCollector;

use Alps\AssetCollector\Events\AssetUrlRequested;
use Alps\AssetCollector\Listeners\CollectAssetId;
use Alps\AssetCollector\Tags\CollectedAssets;
use Statamic\Assets\Asset;

class ServiceProvider extends \Statamic\Providers\AddonServiceProvider
{
    protected $tags = [
        CollectedAssets::class,
    ];

    protected $listen = [
        AssetUrlRequested::class => [
            CollectAssetId::class,
        ],
    ];

    public function register()
    {
        $this->app->bind(Asset::class, \Alps\AssetCollector\Asset::class);
    }
}
