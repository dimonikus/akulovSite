<?php
/* @var $this yii\web\View */
/* @var $images app\models\Image */

$this->params['breadcrumbs'][] = Yii::t('menu', 'Wedding');
$size = 'width="280" height="280"';
?>
<h1><?= Yii::t('menu', 'Wedding') ?></h1>

<div data-nanogallery2>

<?php foreach ($images as $image) { ?>
    <a href="/<?= $image->url ?><?= $image->name ?>"
       data-ngThumb="/<?= $image->url ?><?= 'th_' . $image->name ?>">
    </a>
<?php } ?>
</div>