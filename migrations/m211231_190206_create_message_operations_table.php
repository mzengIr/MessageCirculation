<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%message_operations}}`.
 */
class m211231_190206_create_message_operations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%message_operations}}', [
            'id' => $this->primaryKey(),
            'message_id' => $this->integer()->notNull(),
            'employee_id' => $this->integer()->notNull(),
            'status' => $this->tinyInteger(),
            'created_at' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%message_operations}}');
    }
}
