# ImgYard

Set your images free. Cache and serve up cropped and resized image assets for use on your website

## Features

- Clean simple urls for all your images
- Automatically generates resized and croped images on request
- Caches image for repeated requests

## Requirements

- Laravel 4
- PHP 5.4.*

## Installation (Coming Soon)

Add the following to your root composer.json

    "stwt/image-yard": "*"

Update your packages with __composer update__ or install with __composer install__.

Once Composer has installed or updated your packages you need to register the Mothership with Laravel. Open up app/config/app.php and add the following to the providers key.

    'Stwt\ImgYardServiceProvider',

Next you need to alias Mothership's facade. Find the aliases key which should be below the providers key.

    'ImgYard'      => 'Stwt\ImgYard\ImgYard',

Finally, run __composer dump-autoload__ to updated your autoload class map