<?php

namespace app\models;

use Exception;
use yii\db\ActiveRecord;
use Yii;
use yii\base\InvalidValueException;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;

class DepartmentEmployee extends ActiveRecord 
{

    public static function tableName() {
        return '{{%dept_emp}}';
    }

    
    public function rules() {
        return [
            [['department_id','employee_id'], 'required'],
        ];
    }

    public static function saveEmployee($employee,$department_id) {
        $departmentEmployee = new DepartmentEmployee();
        $departmentEmployee->employee_id = $employee;
        $departmentEmployee->department_id = $department_id;
        if(!$departmentEmployee->save()){
            throw new InvalidValueException('invalid parametrs');
        }
        return true;
    }

    public static function saveManager($manager,$department_id){
        $departmentEmployee = new DepartmentEmployee();
        $departmentEmployee->employee_id = $manager;
        $departmentEmployee->department_id = $department_id;
        if(!$departmentEmployee->save()){
            throw new InvalidValueException('invalid parametrs');
        }
        return true;
    }
    
}
