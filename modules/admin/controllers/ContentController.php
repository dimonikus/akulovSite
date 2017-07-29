<?php

namespace app\modules\admin\controllers;

use app\models\Image;
use yii\helpers\Url;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;

class ContentController extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        $this->layout = '@app/views/layouts/admin';
        if (\Yii::$app->user->isGuest && \Yii::$app->request->url != '/admin/login') {
            $this->redirect(Url::toRoute(['/admin/login']));
        }
    }

    public function actionSlider()
    {
        $model = new Image();
        if (\Yii::$app->request->isPost) {
            $imageFiles = UploadedFile::getInstances($model, 'imageFile');
            foreach ($imageFiles as $file) {
                $model->imageFile = $file;
                if ($model->uploadImage('uploads/slider/')) {
                    echo json_encode(true);
                }
            }
            \Yii::$app->end();
            $this->refresh();
            $model = new Image();
        }

        return $this->render('slider', compact('model'));
    }
}
