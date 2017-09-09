<?php
/* @var $this yii\web\View */
/* @var $images app\models\Image */

$this->title = Yii::t('menu', 'Wedding');
$this->params['breadcrumbs'][] = $this->title;
$size = 'width="280" height="280"';
?>
<h1><?= $this->title ?></h1>

<?php foreach ($images as $image) { ?>
<img src="/<?= $image->url ?><?= $image->name ?>" class="img-thumbnail" alt="Cinque Terre" <?= $size ?>>
<?php } ?>
