<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "meta_info".
 *
 * @property integer $id
 * @property string $page_name
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property integer $robots
 */
class MetaInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meta_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['robots'], 'integer'],
            [['page_name', 'title', 'keywords', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'page_name' => Yii::t('app', 'Page Name'),
            'title' => Yii::t('app', 'Title'),
            'keywords' => Yii::t('app', 'Keywords'),
            'description' => Yii::t('app', 'Description'),
            'robots' => Yii::t('app', 'Robots'),
        ];
    }
}
