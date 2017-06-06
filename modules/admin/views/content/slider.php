<?php
/* @var $this yii\web\View */
use kartik\file\FileInput;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<h1>content/slider</h1>

<p>
    <?php
    echo '<label class="control-label">Add Attachments</label>';
    echo FileInput::widget([
        'model' => $model,
        'attribute' => 'imageFile',
        'options' => ['multiple' => true, 'accept' => 'image/*'],
        'pluginOptions' => [
            'uploadUrl' => Url::to(['/admin/content/slider']),
            'allowedFileExtensions' => ['jpg','png'],
            'maxFileCount' => 10
        ]
    ]);
    ?>
</p>
