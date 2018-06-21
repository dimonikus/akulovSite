<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MetaInfo */

$this->title = $model->page_name;
$this->params['breadcrumbs'][] = ['label' => 'Meta Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meta-info-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'page_name',
            'title',
            'keywords',
            'description',
            [
                'attribute' => 'robots',
                'value' => \app\models\MetaTagManager::getRobotsList()[$model->robots],
            ],
        ],
    ]) ?>

</div>
