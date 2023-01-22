<?php

namespace App\Service;

use Illuminate\Support\Facades\Cache;

class ImageService
{
    public $imagesLinks = [];

    public function getImageInPage(): array
    {
        set_time_limit(-1);
        $images = [];
        foreach ($this->imagesLinks as $link) {
            try {
                if (!Cache::has("link_$link")) {
                    $doc = new \DomDocument();
                    @$doc->loadHTMLFile($link);
                    $xpath = new \DOMXPath($doc);
                    //TODO:Optimize query
                    $xq = $xpath->query(strstr($link, "commitstrip.com") ? '//img[contains(@class,"size-full")]/@src' : '//img/@src');
                    $src = $xq[0]->value;
                    Cache::forever("link_$link", $src);
                }
                $images[] = Cache::get("link_$link");
            } catch (\Exception $e) { /* error */
            }
        }
        return $images;
    }

    public function contentContainsWords(String $str, array $arr): Bool
    {
        foreach ($arr as $a) {
            if (stripos($str, $a) !== false) return true;
        }
        return false;
    }

    public function checkLink(String $link): Bool
    {
        return !empty(trim($link)) && in_array($link, $this->imagesLinks);
    }

    public function addLink(String $link): void
    {
        if (!$this->checkLink($link)) {
            $this->imagesLinks[] = $link;
        }
    }
}
