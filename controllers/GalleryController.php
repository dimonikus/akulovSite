<?php

namespace app\controllers;

use app\models\Image;

class GalleryController extends \yii\web\Controller
{
    public function actionWedding()
    {
        $images = Image::getGalleryImages('uploads/wedding/');

        return $this->render('wedding', compact('images'));
    }

}
