<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%text_page}}".
 *
 * @property integer $id
 * @property string $ru
 * @property string $ua
 * @property string $page_name
 */
class TextPage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%text_page}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ru', 'ua', 'page_name'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ru' => Yii::t('app', 'Текст на странице рус'),
            'ua' => Yii::t('app', 'Текст на странице укр'),
            'page_name' => Yii::t('app', 'Имя страницы'),
        ];
    }
}
