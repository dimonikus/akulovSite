<?php
/* @var $model \app\models\TextPage */
use dosamigos\tinymce\TinyMce;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['id' => 'page-form']);

echo $form->field($model, 'ru')->widget(TinyMce::className(), [
    'options' => ['rows' => 30],
    'language' => 'ru',
    'clientOptions' => [
        'plugins' => [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    ]
]);

echo \yii\helpers\Html::submitButton('Submit', ['class' => 'btn btn-primary']);

ActiveForm::end();
