<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Meta Infos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meta-info-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Meta Info', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'page_name',
            'title',
            'keywords',
            'description',
            // 'robots',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
