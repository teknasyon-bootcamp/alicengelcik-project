<?php
namespace App\Controller;

use Intervention\Image\ImageManagerStatic as Image;

abstract class BaseController{
    public function __invoke()
    {
        // TODO: Implement __invoke() method.
    }

    public function __construct()
    {
        loginPanelControl();
    }
    public static function imageUpload(array $image):string{
        $file = $image;
        try {
            $extension = pathinfo($image["name"])["extension"];
            $img = Image::make($image["tmp_name"]);
            $img->resize(500, 500, function ($constraint) {
                //orantılı küçültme işlemi
                $constraint->aspectRatio();
            });
            $genislik = $img->width();
            $uzunluk = $img->height();
            $img->resizeCanvas(500-$genislik, 500-$uzunluk, 'center', TRUE,'#FFFFFF' );
            $uniqname = uniqid('news_', true);
            $path = "assets/img/news/" . $uniqname . "." . $extension;
            $img->save($path);
            $imgname= $uniqname . "." . $extension;
            return $imgname;
        }catch (Exception $e){
            die("Image Upload Error<br>".$e);
        }
    }
}