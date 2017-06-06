<?php

use yii\db\Migration;

class m170605_001819_add_table_image extends Migration
{
    public function up()
    {
        $this->createTable('image',
            [
                'id' => $this->primaryKey(),
                'url' => $this->string(128)->defaultValue(null)->comment('Путь'),
                'name' => $this->string(128)->defaultValue(null)->comment('Имя картинки'),
            ]
        );
    }

    public function down()
    {
        $this->dropTable('image');
    }
}
