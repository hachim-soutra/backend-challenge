<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;

class FeedXmlService
{

    protected $http;
    const IMAGE_EXTENSIONS = ["jpg", "JPG", "GIF", "gif", "PNG", ".png"];

    public function __construct()
    {
        $this->http = Http::withOptions(["verify" => false]);
    }

    public function fetchData(ImageService $imageService)
    {
        $feed = $this->http->get("https://www.commitstrip.com/en/feed/");
        if ($feed->ok()) {
            $feedXml = simplexml_load_string($feed->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA);
            $feedXmlChannelItem = $feedXml->channel->item;
            foreach ($feedXmlChannelItem as $item) {
                if ($imageService->contentContainsWords((string)$item->children("content", true), self::IMAGE_EXTENSIONS)) {
                    $imageService->addLink((string)$item->link[0]);
                }
            }
        }
    }
}
