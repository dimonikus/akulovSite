<?php

namespace app\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;

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

    public function uploadImage($url)
    {
        $this->name = $this->imageFile->name;
        $this->url = $url;
        if ($this->imageFile->saveAs($url . $this->imageFile->name) && $this->save(false)) {

            return true;
        }

        return false;
    }

    /**
     * @return array
     */
    public static function getSliderImages($imgTag = true)
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

        return $items;
    }
}
