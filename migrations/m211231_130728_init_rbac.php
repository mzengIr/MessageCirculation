<?php

use yii\db\Migration;


class m211231_130728_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // add "selectManager" permission
        $selectManager = $auth->createPermission('selectManager');
        $selectManager->description = 'Selection of department managers';
        $auth->add($selectManager);

        // add "author" role and give this role the "createPost" permission
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $selectManager);

        $auth->assign($admin, 1);

        $employee = $auth->createRole('employee');
        $auth->add($employee);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211231_130728_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
