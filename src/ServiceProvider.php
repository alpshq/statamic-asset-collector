<?php

namespace Alps\Bookmarker;

use Alps\Bookmarker\Events\BookmarkCollectionDeleted;
use Alps\Bookmarker\Events\BookmarkCollectionSaved;
use Alps\Bookmarker\Http\Controllers\SubmitController;
use Alps\Bookmarker\Scopes\Bookmarked;
use Alps\Bookmarker\Stache\BookmarkStore;
use Alps\Bookmarker\Tags\Bookmarker;
use Illuminate\Routing\Middleware\ValidateSignature;
use Illuminate\Support\Facades\Route;
use phpDocumentor\Reflection\Types\Self_;
use Statamic\Git\Subscriber;
use Statamic\Stache\Stache;
use Statamic\Statamic;

class ServiceProvider extends \Statamic\Providers\AddonServiceProvider
{
    protected $stylesheets = [
//        __DIR__ . '/../dist/css/bookmarker-cp.css',
    ];

    protected $scripts = [
//        __DIR__ . '/../dist/js/bookmarker-cp.js',
    ];

    protected $publishables = [
//        __DIR__ . '/../dist/css' => 'css',
//        __DIR__ . '/../dist/js' => 'js',
    ];

    protected $fieldtypes = [
    ];

    protected $tags = [
        Bookmarker::class,
    ];

    protected $scopes = [
//        Bookmarked::class,
    ];

    protected $listen = [
//        BookmarkCollectionSaved::class => [
//            Subscriber::class . '@commit',
//        ],
//        BookmarkCollectionDeleted::class => [
//            Subscriber::class . '@commit',
//        ],
    ];

    public function register()
    {
        $this->registerAddonConfig();

//        $this->app->singleton();
    }

    public function bootAddon()
    {
//        $this->bootStores();

//        $this->registerWebRoutes(function() {
//            Route::prefix('bookmarker/submit')
//                ->name('bookmarker.submit.')
//                ->controller(SubmitController::class)
//                ->middleware(ValidateSignature::class)
//                ->group(function() {
//                    Route::post('', 'handlePost')->name('post');
//                    Route::delete('', 'handleDelete')->name('delete');
//                });
//        });

        Statamic::afterInstalled(function ($command) {
            $command->call('vendor:publish', [
                '--tag' => 'statamic-asset-collector',
                '--force' => true,
            ]);
        });
    }

    private function registerAddonConfig(): self
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/asset-collector.php', 'statamic.asset-collector');

        $this->publishes([
            __DIR__ . '/../config/asset-collector.php' => config_path('statamic/asset-collector.php'),
        ], 'statamic-asset-collector-config');

        return $this;
    }

//    private function bootStores(): self
//    {
//        $bookmarkerStore = new BookmarkStore();
//        $bookmarkerStore->directory(
//            config('statamic.bookmarker.bookmark_store', base_path('content/bookmarks'))
//        );
//
//        /** @var Stache $stache */
//        $stache = $this->app->make(Stache::class);
//
//        $stache->registerStore($bookmarkerStore);
//
//        return $this;
//    }
}
