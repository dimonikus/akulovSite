<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = \Yii::t('menu', 'About');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div>
        <?= $model->ru ?>
    </div>

</div>
