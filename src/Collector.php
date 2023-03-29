<?php

namespace Alps\AssetCollector;

use Spatie\Blink\Blink as SpatieBlink;
use Statamic\Facades\Blink as BlinkFacade;

class Collector
{
    const STORE_NAME = 'asset_collector';

    const STORE_KEY = 'collected_ids';

    private SpatieBlink $blink;

    public function __construct()
    {
        $this->blink = BlinkFacade::store(self::STORE_NAME);
    }

    public function get(): array
    {
        $collectedIds = $this->blink->get(self::STORE_KEY);

        if ($collectedIds) {
            $collectedIds = json_decode($collectedIds, true);
        }

        return $collectedIds ?? [];
    }

    public function set(array $assetIds): self
    {
        $assetIds = array_unique($assetIds);
        $assetIds = array_values($assetIds);

        $this->blink->put(self::STORE_KEY, json_encode($assetIds));

        return $this;
    }

    public function addId(string $assetId): self
    {
        $collected = $this->get();

        $collected[] = $assetId;

        $this->set($collected);

        return $this;
    }
}
