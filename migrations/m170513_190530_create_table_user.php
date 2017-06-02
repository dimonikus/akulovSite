<?php

use yii\db\Migration;

class m170513_190530_create_table_user extends Migration
{
    public function up()
    {
        $this->createTable('user',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string(128)->defaultValue(null)->comment('Имя пользователя'),
                'password' => $this->string(128)->notNull()->comment('пароль'),
                'access_level' => $this->integer(1)->notNull()->defaultValue(1)->comment('Уровень доступа')
            ]
        );

        $this->insert('user',
            [
                'id' => 1,
                'name' => 'admin',
                'password' => '21232f297a57a5a743894a0e4a801fc3',
                'access_level' => '7',
            ]
        );
    }

    public function down()
    {
        $this->dropTable('user');
    }
}
