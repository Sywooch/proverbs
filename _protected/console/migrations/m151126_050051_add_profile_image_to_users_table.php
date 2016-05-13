<?php

use yii\db\Schema;
use yii\db\Migration;

class m151126_050051_add_profile_image_to_users_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}','profile_image', $this->string(255));
    }

    public function down()
    {
        $this->dropColumn('{{%user}}','profile_image');
    }
}
