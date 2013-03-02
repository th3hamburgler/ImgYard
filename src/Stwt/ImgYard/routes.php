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

$imageModel;

Route::model('image', 'Stwt\Beheartofit\Image');
Route::get('img/{image}', 'Stwt\ImgYard\ImgYardController@getImage');
