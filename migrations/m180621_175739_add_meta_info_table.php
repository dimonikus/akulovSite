<?php

use yii\db\Migration;

class m180621_175739_add_meta_info_table extends Migration
{
    public $tblName = 'meta_info';

    public function up()
    {
        $this->createTable($this->tblName, [
            'id' => $this->primaryKey(),
            'page_name' => $this->string(),
            'title' => $this->string(),
            'keywords' => $this->string(),
            'description' => $this->string(),
            'robots' => $this->integer(4),
        ]);
    }

    public function down()
    {
        $this->dropTable($this->tblName);
    }
}
