<?php
use evgeniyrru\yii2slick\Slick;
use yii\helpers\Html;
use yii\web\JsExpression;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <img src="/img/logo.png">

        <?php
        // http://www.yiiframework.com/extension/yii2-slick
        echo Slick::widget([
            // HTML tag for container. Div is default.
            'itemContainer' => 'div',

            // HTML attributes for widget container
            'containerOptions' => ['class' => 'container'],

            // Items for carousel. Empty array not allowed, exception will be throw, if empty
            'items' => [
                Html::img('http://akulov.kiev.ua/wedding/IMG_7161_sp.jpg', ['style' => 'width: 100%']),
                Html::img('http://akulov.kiev.ua/wedding/site_IMG_0736.jpg', ['style' => 'width: 100%']),
                Html::img('http://akulov.kiev.ua/wedding/IMG_2891_2.jpg', ['style' => 'width: 100%']),
                Html::img('http://akulov.kiev.ua/wedding/site_MG_3188.jpg', ['style' => 'width: 100%']),
                Html::img('http://akulov.kiev.ua/wedding/4.jpg', ['style' => 'width: 100%']),
            ],

            // HTML attribute for every carousel item
            'itemOptions' => ['class' => 'cat-image'],

            // settings for js plugin
            // @see http://kenwheeler.github.io/slick/#settings
            'clientOptions' => [
                'autoplay' => true,
                'dots'     => true,
                // note, that for params passing function you should use JsExpression object
                'onAfterChange' => new JsExpression('function() {console.log("The cat has shown")}'),
            ],
        ]);
        ?>
    </div>

</div>
