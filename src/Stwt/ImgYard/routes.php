<?php

/*
|--------------------------------------------------------------------------
| ImgYard Routes
|--------------------------------------------------------------------------
|
| Here is where we register the ImgYard controller. This is the route all
| image request will pass through.
*/


// IMAGES

//use Stwt\Beheartofit\Image as Image;

$controllers = Config::get('img-yard.controllers');

foreach ($controllers as $array) {
    $uri = $array['uri'];
    $model = $array['model'];
    $_model = 'img_yard_'.strtolower($model);
    $controller = $array['controller'];

    Route::model($_model, $model);
    Route::get($uri.'/{'.$_model.'}', $controller.'@getImage');
}
