<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employees}}`.
 */
class m211231_055405_create_employees_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%employees}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(64)->notNull(),
            'password' => $this->string(64)->notNull(),
            'auth_key' => $this->string(64)->notNull(),
            'name' => $this->string(64)->null(),
            'family' => $this->string(64)->null(),
            'birth_date' => $this->date()->null(),
            'national_code' => $this->string(16)->null(),
            'ip' => $this->string(16)->notNull(),
            'type' => $this->tinyInteger(1)->defaultValue(1)->notNull(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP')
        ]);


        $this->insert('{{%employees}}', [
            'username' => 'admin',
            'password' =>  Yii::$app->security->generatePasswordHash('admin'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'type' => '3',
            'ip' => '192.168.1.1'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%employees}}');
    }
}
