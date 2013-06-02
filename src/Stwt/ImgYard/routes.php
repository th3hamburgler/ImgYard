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

Log::error('got images');

foreach ($controllers as $array) {
    $uri = $array['uri'];
    $model = $array['model'];
    //$_model = 'img_yard_'.strtolower($model);
    $controller = $array['controller'];

    //Route::model($_model, $model);
    //Route::get($uri.'/{'.$_model.'}', $controller.'@getImage');

    Route::get($uri.'/{id}/{size}', $controller.'@getImage');
}
