<?php

namespace app\models;

use Exception;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use Yii;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;

class Employee extends ActiveRecord implements IdentityInterface
{
    const TYPE_EMPLOYEE = 1;
    const TYPE_MANAGER = 2;


    public static function tableName()
    {
        return '{{%employees}}';
    }


    public function rules()
    {
        return [
            [['username', 'password', 'national_code', 'type', 'name', 'family'], 'required'],
            [['username', 'password', 'name', 'family', 'auth_key'], 'string', 'max' => 64],
            [['national_code', 'ip'], 'string', 'max' => 16],
        ];
    }


    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public static function saveManager($id)
    {
        $employee = Employee::findOne($id);
        $employee->type = Employee::TYPE_MANAGER;
        return $employee->save();
    }

    public function getId()
    {
        return $this->id;
    }


    public static function getType($id)
    {
        $employee = Employee::find()->select('type')->where(['id' => $id])->one();
        return $employee->type;
    }

    public static function getDepartment($id)
    {
        $dep_emp = DepartmentEmployee::find()->where(['employee_id' => $id])->one();
        if(!$dep_emp)
            return '';
        $department = Department::findOne($dep_emp->department_id);
        return $department->name;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }


    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token
        ]);
    }

    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public static function getEmployeesDropdown()
    {
        $dept_emp = DepartmentEmployee::find()->select('employee_id');
        $employees = Employee::find()->select('id,username')->where(['<>', 'id', 1])
            ->andFilterWhere(['not in', 'id', $dept_emp])
            ->all();

        $employees   = ArrayHelper::map($employees, 'id', 'username');
        if (!$employees) {
            throw new NotFoundHttpException('no employee to show');
        }
        return $employees;
    }

    public static function getManagers()
    {
        $managers =  Employee::find()->select('id,username')
            ->where(['type' => self::TYPE_MANAGER])
            ->andWhere(['<>', 'id', Yii::$app->user->identity->id])
            ->all();
        return ArrayHelper::map($managers, 'id', 'username');
    }
}
