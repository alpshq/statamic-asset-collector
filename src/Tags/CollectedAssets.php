<?php

namespace Alps\AssetCollector\Tags;

use Alps\AssetCollector\Collector;
use Illuminate\Support\Collection;
use Statamic\Assets\Asset;
use Statamic\Facades\Asset as AssetFacade;
use Statamic\Tags\Tags;

class CollectedAssets extends Tags
{
    public function __construct(private Collector $collector)
    {
    }

    private function getCollectedAssets(): Collection
    {
        return collect($this->collector->get())
            ->map(function (string $id) {
                return AssetFacade::find($id);
            })
            ->filter()
            ->values();
    }

    /**
     * The {{ collected_assets }} tag.
     */
    public function index()
    {
        return $this->getCollectedAssets()->all();
    }

    /**
     * The {{ collected_assets:images }} tag.
     */
    public function some()
    {
        $image = (bool) $this->params->get('image', false);
        $svg = (bool) $this->params->get('svg', false);
        $video = (bool) $this->params->get('video', false);
        $audio = (bool) $this->params->get('audio', false);
        $pdf = (bool) $this->params->get('pdf', false);

        return $this->getCollectedAssets()
            ->filter(function (Asset $asset) use ($image, $svg, $video, $audio, $pdf) {
                if ($image && $asset->isImage()) {
                    return true;
                }

                if ($svg && $asset->isSvg()) {
                    return true;
                }

                if ($video && $asset->isVideo()) {
                    return true;
                }

                if ($audio && $asset->isAudio()) {
                    return true;
                }

                if ($pdf && $asset->isPdf()) {
                    return true;
                }

                return false;
            })
            ->values()
            ->all();
    }
}
