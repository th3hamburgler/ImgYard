<?php

/*
|--------------------------------------------------------------------------
| ImgYard Routes
|--------------------------------------------------------------------------
|
| Here is where we register the ImgYard controller. This is the route all
| image request will pass through.
*/

$controllers = Config::get('img-yard::controllers');

foreach ($controllers as $array) {
    $uri = $array['uri'];
    $model = $array['model'];
    $controller = $array['controller'];
    Route::get($uri.'/{id}/{size}', $controller.'@getImage');
}
