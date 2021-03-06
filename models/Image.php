<?php

namespace app\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;
use yii\imagine\Image as Img;
use Imagine\Image\Box;

/**
 * This is the model class for table "{{%image}}".
 *
 * @property integer $id
 * @property string $url
 * @property string $name
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%image}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'name'], 'string', 'max' => 128],
            [['imageFile'], 'safe'],
            [['imageFile'], 'file', 'extensions'=>'jpg, gif, png'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'url' => Yii::t('app', 'Путь'),
            'name' => Yii::t('app', 'Имя картинки'),
        ];
    }

    public function generateName()
    {
        return date('Ymd_', time()) . Yii::$app->security->generateRandomString(6);
    }

    /**
     * @param $url
     * @return bool
     */
    public function uploadImage($url)
    {
        $extension = $this->imageFile->extension;
        $this->name = $this->generateName() . '.' . $extension;
        $this->url = $url;
        if ($this->imageFile->saveAs($url . $this->name) && $this->save(false)) {
            Img::thumbnail($url . $this->name, 500, 300)
                ->resize(new Box(500,300))
                ->save($url . 'th_' . $this->name, ['quality' => 70]);

            return true;
        }

        return false;
    }


    /**
     * @param bool $imgTag
     * @param bool $model
     * @return array | Image model
     */
    public static function getSliderImages($imgTag = true, $model = false)
    {
        $img = Image::find()->where(['url' => 'uploads/slider/'])->all();
        $items = [];
        if ($img) {
            foreach ($img as $image) {
                $items[] = $imgTag
                    ? Html::img(DIRECTORY_SEPARATOR . $image->url . $image->name, ['style' => 'width: 100%'])
                    : '/' . $image->url . $image->name
                ;
            }
        }

        return $model ? $img : $items;
    }

    public static function getGalleryImages($gallery = 'uploads/slider/')
    {
        return Image::find()->where(['url' => $gallery])->all();
    }

    public static function deleteImage($id)
    {
        if ($img = Image::find()->where(['id' => $id])->one()) {
            if (file_exists(Yii::getAlias('@root') . '/' . $img->url . 'th_' . $img->name)) {
                unlink (Yii::getAlias('@root') . '/' . $img->url . 'th_' . $img->name);
            }
            unlink (Yii::getAlias('@root') . '/' . $img->url . $img->name);
            $img->delete();

            return true;
        }

        return false;
    }
}
