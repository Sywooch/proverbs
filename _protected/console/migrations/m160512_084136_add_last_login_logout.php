<?php

use yii\db\Migration;

class m160512_084136_add_last_login_logout extends Migration
{
    public function up()
    {   
        $this->addColumn('{{%user}}','last_login', $this->integer(11));
        $this->addColumn('{{%user}}','last_logout', $this->integer(11));
    }

    public function down()
    {
        $this->dropColumn('{{%user}}','last_login');
        $this->dropColumn('{{%user}}','last_logout');
    }
}
