<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->params['breadcrumbs'][] = \Yii::t('menu', 'Contact');
?>
<div class="site-contact">
    <h1><?= \Yii::t('menu', 'Contact') ?></h1>

    <div>
        <?= $model->ru ?>
    </div>

</div>
