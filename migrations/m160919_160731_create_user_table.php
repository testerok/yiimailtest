<?php

use yii\db\Migration;

/**
 * Handles the creation for table `yiiusers`.
 */
class m160919_160731_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('yiiusers', [
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
        $this->dropTable('yiiusers');
    }
}