<?php
/* @var $this yii\web\View */
/* @var $model \app\models\Image */

use kartik\file\FileInput;
use yii\helpers\Url;
use app\models\Image;

$initialPreview = $initialPreviewConfig = [];
foreach (Image::getSliderImages(false, true) as $img) {
    $initialPreview[] = '/' . $img->url . $img->name;
    $initialPreviewConfig[] = [
        'caption' => $img->name,
        'url' => Url::toRoute(['/admin/content/delete']),
        'key' => $img->id,
        'extra' => ['id' => $img->id]
    ];
}
?>
    <h1>content/slider</h1>

    <p>
        <?php
        echo '<label class="control-label">Add Attachments</label>';
        echo FileInput::widget([
            'model' => $model,
            'attribute' => 'imageFile[]',
            'options' => ['multiple' => true, 'accept' => 'image/*'],
            'pluginOptions' => [
                'initialPreview' => $initialPreview,
                'initialPreviewAsData' => true,
                'overwriteInitial' => false,
                'uploadUrl' => Url::to(['/admin/content/slider']),
                'allowedFileExtensions' => ['jpg', 'png'],
                'maxFileCount' => 10,
                'showRemove' => false,
                'showUpload' => true,
                'initialPreviewConfig' => $initialPreviewConfig,
            ],
            'pluginEvents' => [
                "fileuploaded" => "function(event, data, previewId, index) {
                    window.location.href = '/admin/content/slider';
                }",
            ]
        ]);
        ?>
    </p>


<?php
//echo FileInput::widget([
//    'model' => $model,
//    'attribute' => 'imageFiles[]',
//    'options' => ['multiple' => true, 'accept' => 'image/*'],
//    'pluginOptions' => [
//        'initialPreview' => $preview,
//        'initialPreviewAsData' => true,
//        'overwriteInitial' => false,
//        'uploadUrl' => Url::to(['upload-images', 'id' => $model->id]),
//        'allowedFileExtensions' => ['jpg', 'png'],
//        'showCaption' => true,
//        'showRemove' => false,
//        'showUpload' => true,
//
//        'uploadAsync' => true,
//
//        'initialPreviewConfig' => $init,
//    ],
//    'pluginEvents' => [
//        "fileuploaded" => "function(event, data, previewId, index) {
//window.location.href = '/cms/products/default/update?id='+$('#product-id').val()+'&activeTab=Images';
//}",
//        "filesorted" => "function(event, params) {
//params.stack.forEach(function(item, i, arr) {
//$('#image-'+item.key).val(i)
//});
//}",
//    ],
//]);

//http://plugins.krajee.com/file-preview-management-demo#preview-data
//http://plugins.krajee.com/file-input#events