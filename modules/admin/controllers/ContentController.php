<?php

namespace app\modules\admin\controllers;

use yii\helpers\Url;
use yii\filters\VerbFilter;

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
        return $this->render('slider');
    }

}
