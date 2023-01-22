Technical challenge Stayhere
========

## project installation
* install dependencies `composer install`
* run `php artisan serve`

## Description

A trainee created the code in the app/Controllers/HomeController.php.

This controller retrieves content from an RSS feed and call a news api. The result is filtered to fetch those containing images and verify if aren't duplicated.
This script should get an image from each page.

The lead developer is not satisfied by this result, so you need to improve it.

## Questions:
1. What do you suggest improving the run time of this script?
    - create queued jobs that may be processed in the background and add put images source in cache if not   exists in cache when images finish sent pusher signal to front-end(add message or loading animation).
2. How can we make this script scalable (make it support thousands of image sources).
  - i think we need to create task schedule that execute every hours that get images source and put in cache in controller make paginate system or load more and get 20 by 20 from the cache.


## Resources
https://refactoring.guru/
https://refactoring.com/catalog/
