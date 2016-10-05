<?php

use yii\db\Migration;

/**
 * Handles the creation for table `user`.
 */
class m160919_160731_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => Schema::TYPE_PK,
			'username' => Schema::TYPE_STRING.' NOT NULL',
			'email' => Schema::TYPE_STRING.' NOT NULL',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}