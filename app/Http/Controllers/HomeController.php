<?php


namespace App\Http\Controllers;

use App\Service\FeedXmlService;
use App\Service\ImageService;
use App\Service\NewsApiService;

class HomeController extends Controller
{
    public function index(ImageService $imageService, FeedXmlService $feedXmlService, NewsApiService $newsApiService)
    {
        $feedXmlService->fetchData($imageService);
        $newsApiService->fetchData($imageService);
        return view('index', [
            'images' => $imageService->getImageInPage()
        ]);
    }
}
