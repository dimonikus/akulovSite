<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->params['breadcrumbs'][] = \Yii::t('menu', 'About');
?>
<div class="site-about">
    <h1><?= \Yii::t('menu', 'About') ?></h1>

    <div>
        <?= $model->ru ?>
    </div>

</div>
