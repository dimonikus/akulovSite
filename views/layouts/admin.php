<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Admin Panel',
        'brandUrl' => \yii\helpers\Url::to(['/admin/index']),
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            [
                'label' => 'Content',
                'items' => [
                    ['label' => 'slider', 'url' => ['/admin/content/slider']],
                    ['label' => 'main', 'url' => ['/admin/content/text-page', 'pageName' => 'main']],
                    ['label' => 'about', 'url' => ['/admin/content/text-page', 'pageName' => 'about']],
                    ['label' => 'contact', 'url' => ['/admin/content/text-page', 'pageName' => 'contact']],
                    ['label' => 'wedding', 'url' => ['/admin/content/wedding']],
//                    '<li class="divider"></li>',
//                    '<li class="dropdown-header">Dropdown Header</li>',
//                    ['label' => 'Level 1 - Dropdown B', 'url' => '#'],
                ],
            ],
//            ['label' => 'About', 'url' => ['/site/about']],
//            ['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
            ['label' => Yii::t('menu', 'Login'), 'url' => ['/admin/default/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/admin/default/logout'], 'post')
                . Html::submitButton(
                    Yii::t('menu', 'Logout'),
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
