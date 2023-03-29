<?php

namespace Alps\AssetCollector\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AssetUrlRequested
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * @param string|int $id the Asset ID
     */
    public function __construct(public $id)
    {
    }
}
