<?php

use yii\db\Schema;
use yii\db\Migration;

class m151117_034019_add_profile_details_to_users_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}','first_name', $this->string(45)->notNull());
        $this->addColumn('{{%user}}','middle_name', $this->string(45)->notNull());
        $this->addColumn('{{%user}}','last_name', $this->string(45)->notNull());
        $this->addColumn('{{%user}}','gender', $this->string(7)->notNull());
        $this->addColumn('{{%user}}','birth_date', $this->date());
        $this->addColumn('{{%user}}','address', $this->string(255)->notNull());
        $this->addColumn('{{%user}}','phone', $this->integer(11));
        $this->addColumn('{{%user}}','mobile', $this->bigInteger(20));
        $this->addColumn('{{%user}}','notes', $this->string(255));
    }

    public function down()
    {
        $this->dropColumn('{{%user}}','first_name');
        $this->dropColumn('{{%user}}','middle_name');
        $this->dropColumn('{{%user}}','last_name');
        $this->dropColumn('{{%user}}','gender');
        $this->dropColumn('{{%user}}','birth_date');
        $this->dropColumn('{{%user}}','address');
        $this->dropColumn('{{%user}}','phone');
        $this->dropColumn('{{%user}}','mobile');
        $this->dropColumn('{{%user}}','notes');
    }
}
