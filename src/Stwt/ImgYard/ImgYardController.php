<?php namespace Stwt\ImgYard;

use Controller;
use Input;
use Response;

class ImgYardController extends Controller
{
    private $headers = ['Content-type' => 'image/png'];
    private $image;
    protected $model = 'Image';

    public function getImage($imageId, $size = null)
    {
        $model = $this->model;
        $image = $model::find($imageId);

        /*$width  = Input::get('w');
        $height = Input::get('h');

        if ($width && $height) {
            if ($width == $height) {
                return $this->thumbnailImage($width, $height);
            } else {
                return $this->cropAndResizeImage($width, $height);
            }
        } elseif ($width) {
            return $this->resizeImageByWidth($width);
        } elseif ($height) {
            return $this->resizeImageByHeight($height);
        }*/

        $data = $image->getFile($size);

        return Response::make($data, 200, $this->headers);
    }

    private function thumbnailImage($width, $height)
    {
        $name   = $width.'x'.$height;

        if (file_exists($this->image->getFilePath($name))) {
            return $this->returnCachedImage($name);
        }

        $layer  = \PHPImageWorkshop\ImageWorkshop::initFromPath($this->image->getFilePath());

        $layer->cropMaximumInPixel(0, 0, "MM");
        $layer->resizeInPixel($width, $height);

        return $this->saveNewImage($layer, $name);
    }

    private function cropAndResizeImage($width, $height, $thumbnail = true)
    {
        $name   = $width.'x'.$height;
        
        if (file_exists($this->image->getFilePath($name))) {
            return $this->returnCachedImage($name);
        }

        $layer  = \PHPImageWorkshop\ImageWorkshop::initFromPath($this->image->getFilePath());
            
        $_width     = $layer->getWidth();
        $_height    = $layer->getHeight();

        if ($width >= $height) {
            $ratio = $_width / $width;
        } else {
            $ratio = $_height / $height;
        }

        $newWidth   = $ratio * $width;
        $newHeight  = $ratio * $height;
        $position   = "MM";

        $layer->cropInPixel($newWidth, $newHeight, 0, 0, $position);
        $layer->resizeInPixel($width, $height);

        return $this->saveNewImage($layer, $name);
    }

    private function resizeImageByWidth($width)
    {
        return $this->resizeImage($width, null, 'w_'.$width);
    }

    private function resizeImageByHeight($height)
    {
        return $this->resizeImage(null, $height, 'h_'.$height);
    }

    private function resizeImage($width = null, $height = null, $name = '')
    {
        if (file_exists($this->image->getFilePath($name))) {
            return $this->returnCachedImage($name);
        }
        $layer = \PHPImageWorkshop\ImageWorkshop::initFromPath($this->image->getFilePath());
        $layer->resizeInPixel($width, $height, true);
        return $this->saveNewImage($layer, $name);
    }

    private function saveNewImage($layer, $name)
    {
        // Saving the result
        $dirPath            = $this->image->getPath($name);
        $filename           = $this->image->getFileName();
        $createFolders      = true;
        $backgroundColor    = null;
        $imageQuality       = 95;

        $layer->save(
            $dirPath,
            $filename,
            $createFolders,
            $backgroundColor,
            $imageQuality
        );
        return $this->returnCachedImage($name);
    }

    private function returnCachedImage ($name)
    {
        return Response::make($this->image->getUrl($name), 200, $this->headers);
    }
}
