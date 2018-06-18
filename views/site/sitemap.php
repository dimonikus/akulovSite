<?php
/**
 * Created by PhpStorm.
 * User: shark
 * Date: 19.06.2018
 * Time: 0:56
 */
/* @var $this yii\web\View */
/* @var $map array */
use yii\helpers\Html;
$this->title = \Yii::t('app', 'site map');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-sitemap">
    <h1><?= Html::encode(mb_convert_case($this->title, MB_CASE_TITLE)) ?></h1>

    <div class="sitemap">
        <?php foreach ($map as $key => $value): ?>
            <ul>
                <?php if (!empty($value['url'])): ?>
                    <?= Html::a($value['label'], $value['url']) ?>
                <?php else: ?>
                    <?= $value['label'] ?>
                <?php endif; ?>
                <?php if (!empty($value['level'])): ?>
                    <?php foreach ($value['level'] as $level): ?>
                        <li>
                            <?= Html::a($level['label'], $level['url']) ?>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        <?php endforeach; ?>
    </div>

</div>
