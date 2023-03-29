<?php

namespace Alps\AssetCollector;

use Alps\AssetCollector\Events\AssetUrlRequested;

class Asset extends \Statamic\Assets\Asset
{
    public function url()
    {
        AssetUrlRequested::dispatch($this->id());

        return parent::url();
    }

    public function absoluteUrl()
    {
        AssetUrlRequested::dispatch($this->id());

        return parent::absoluteUrl();
    }
}
