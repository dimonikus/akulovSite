<?php

use yii\db\Migration;

class m170814_162835_add_text_page_table extends Migration
{
    public function up()
    {
        $this->createTable('text_page',
            [
                'id' => $this->primaryKey(),
                'ru' => $this->text()->defaultValue(null)->comment('Текст на странице рус'),
                'ua' => $this->text()->defaultValue(null)->comment('Текст на странице укр'),
                'page_name' => $this->string(128)->defaultValue(null)->comment('Имя страницы'),
            ]
        );
    }

    public function down()
    {
        $this->dropTable('text_page');
    }
}
