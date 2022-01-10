<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%dept_emp}}`.
 */
class m211231_055456_create_dept_emp_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%dept_emp}}', [
            'id' => $this->primaryKey(),
            'department_id' => $this->integer()->notNull(),
            'employee_id' => $this->integer()->notNull()
        ]);
        $this->addForeignKey(
            'fk-dept_emp-department_id',
            'dept_emp',
            'department_id',
            'departments',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-dept_emp-employee_id',
            'dept_emp',
            'employee_id',
            'employees',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%dept_emp}}');
    }
}
