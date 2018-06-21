<?php

namespace app\controllers;

use app\models\Image;
use app\models\MetaTagManager;

class GalleryController extends \yii\web\Controller
{
    public function actionWedding()
    {
        $images = Image::getGalleryImages('uploads/wedding/');
        MetaTagManager::registerMetaTags('gallery/wedding');

        return $this->render('wedding', compact('images'));
    }

}
