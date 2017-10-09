<?php

namespace app\modules\admin\controllers;

use app\models\Image;
use app\models\TextPage;
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

    public function actionWedding()
    {
        $model = new Image();
        if (\Yii::$app->request->isPost) {
            $imageFiles = UploadedFile::getInstances($model, 'imageFile');
            foreach ($imageFiles as $file) {
                $model->imageFile = $file;
                if ($model->uploadImage('uploads/wedding/')) {
                    echo json_encode(true);
                }
            }
            \Yii::$app->end();
            $this->refresh();
            $model = new Image();
        }

        return $this->render('wedding', compact('model'));
    }

    public function actionDelete()
    {
        if (\Yii::$app->request->isPost) {
            echo json_encode(Image::deleteImage(\Yii::$app->request->post('id')));
        }

        \Yii::$app->end();
    }

    public function actionAbout()
    {
        if (!$model = TextPage::findOne(['page_name' => 'about'])) {
            $model = new TextPage();
            $model->page_name = 'about';
        }
        if (\Yii::$app->request->isPost && $model->load(\Yii::$app->request->post())) {
            if ($model->save()) {
                \Yii::$app->session->setFlash('success', 'Текстовая страница успешно сохранена');
            }
        }

        return $this->render('about', compact('model'));
    }
}
