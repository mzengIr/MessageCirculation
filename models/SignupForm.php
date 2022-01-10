<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Employee;


class SignupForm extends Model
{
    public $username;
    public $password;
    public $name;
    public $family;
    public $birthDate;
    public $nationalCode;


    public function rules()
    {
        return [
            [['username', 'password','nationalCode','name' ,'family'], 'required'],
            [['username', 'password','name' ,'family'], 'string', 'max' => 64],
            [['nationalCode'], 'string', 'max' => 16],
        ];
    }

    public function signup()
    {
        if ($this->validate()) {
            $employee = new Employee();
            $employee->username = $this->username;
            $employee->name = $this->name;
            $employee->family = $this->family;
            $employee->national_code = $this->nationalCode;
            $employee->birth_date = $this->birthDate;
            $employee->ip = Yii::$app->request->userIP;
            $employee->type = Employee::TYPE_EMPLOYEE;
            $employee->setPassword($this->password);
            $employee->generateAuthKey();
            if ($employee->save()) {
                $auth = Yii::$app->authManager;
                $authorRole = $auth->getRole('employee');
                $auth->assign($authorRole, $employee->id);
                return $employee;
            }
            
        }
        return false;
    }

}
