<?php
use evgeniyrru\yii2slick\Slick;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $items array */
/* @var $text \app\models\TextPage */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="text-center">
        <img src="/img/logo.png">

        <?php
        if (!empty($items)) {
            // http://www.yiiframework.com/extension/yii2-slick
            echo Slick::widget([
                // HTML tag for container. Div is default.
                'itemContainer' => 'div',

                // HTML attributes for widget container
                'containerOptions' => ['class' => 'container'],

                // Items for carousel. Empty array not allowed, exception will be throw, if empty
                'items' => $items,

                // HTML attribute for every carousel item
                'itemOptions' => ['class' => 'cat-image'],

                // settings for js plugin
                // @see http://kenwheeler.github.io/slick/#settings
                'clientOptions' => [
                    'autoplay' => true,
                    'dots' => true,
                    // note, that for params passing function you should use JsExpression object
                    'onAfterChange' => new JsExpression('function() {console.log("The cat has shown")}'),
                ],
            ]);
        }
        ?>
    </div>

    <div>
        <?php
        if (!empty($text)) {
            echo $text->ru;
        }
        ?>
    </div>
</div>
