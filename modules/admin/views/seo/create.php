<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MetaInfo */

$this->title = 'Create Meta Info';
$this->params['breadcrumbs'][] = ['label' => 'Meta Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meta-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
