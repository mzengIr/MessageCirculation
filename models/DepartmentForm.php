<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Employee;
use app\models\Department;

class DepartmentForm extends Model
{
    public $name;
    public $employees;
    public $manager;

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 64],
        ];
    }

    public function __construct()
    {
        $this->employees = Employee::getEmployeesDropdown();
    }

    public function save($post){
        if($this->validate()){
            $department = new Department();
            $department->name = $this->name;
            $department->created_at = date('Y-m-d h:i:s');
            if($department->save()){
                $manager_id = $post['DepartmentForm']['manager'];
                DepartmentEmployee::saveManager($manager_id,$department->id);
                Employee::saveManager($manager_id);
                $employees = $post['DepartmentForm']['employees'];
                foreach($employees as $employee){
                    DepartmentEmployee::saveEmployee($employee,$department->id);
                }
                Yii::$app->session->setFlash('addedManagerAndEmployee', 'All Employee and manager of this department were added');
            }
        }
    }

}
