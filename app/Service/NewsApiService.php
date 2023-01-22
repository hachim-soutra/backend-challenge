<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;

class NewsApiService
{

    protected $http;

    public function __construct()
    {
        $this->http = Http::withOptions(["verify" => false]);
    }

    public function fetchData(ImageService $imageService)
    {
        $newsApi = $this->http->get("https://newsapi.org/v2/top-headlines?country=ma&apiKey=7b8966140fe9405bad22f7072d507072");
        if ($newsApi->ok()) {
            $newsApiData = json_decode(json_encode($newsApi->json()), FALSE);
            foreach ($newsApiData->articles as $article) {
                $imageService->addLink((string)$article->url);
            }
        }
    }
}
