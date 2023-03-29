<?php

namespace Alps\Bookmarker\Tags;

use Alps\Bookmarker\Data\Bookmark;
use Alps\Bookmarker\Data\BookmarkCollection;
use Alps\Bookmarker\Services\PayloadHasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Statamic\Facades\Antlers;
use Statamic\Support\Arr;
use Statamic\Tags\Context;
use Statamic\Tags\Tags;
use Statamic\View\Cascade;

class Bookmarker extends Tags
{
    public function __construct(private Request $request, private PayloadHasher $payloadHasher)
    {
    }

    /**
     * The {{ bookmarker }} tag.
     */
    public function index()
    {
        $id = $this->params->get('id');

        $scalars = $this->params->filter(fn ($value) => is_scalar($value))->all();

//        BookmarkCollection::query()
//            ->whereNotNull('items.lol')
//            ->where('items.lol', false)
//            ->count();

        $collection = BookmarkCollection::user();
        $bookmark = $collection->getBookmark($id);

        if (!$bookmark) {
            $bookmark = Bookmark::make([
                'id' => $id,
            ]);
        }

        $data = array_merge($scalars, [
            'bookmark' => $bookmark,
        ]);

        $this->setContext([]);

        $data['slot'] = $this->isPair ? trim($this->parse($data)) : null;

        $payload = $this->payloadHasher->createPayload($this->content, $scalars, [
            'path' => $this->request->path(),
        ]);
        $hash = $this->payloadHasher->calculateHash($payload);

        $params = [
            'id' => $id,
            'payload_signature' => $hash,
        ];

        $url = URL::signedRoute('bookmarker.submit.post', $params);

        return view('statamic-bookmarker::bookmark', array_merge($data, [
            'payload' => $payload,
            'hash' => $hash,
            'action' => $url,
        ]));
    }
}
