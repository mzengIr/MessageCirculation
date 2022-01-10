<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Employee;

class MessageForm extends Model
{
    public $content;
    public $receiver_id;
    public $sender_id;
    public $department_id;
    public $status;

    public function rules()
    {
        return [
            [['content'], 'required'],
            [['receiver_id','sender_id','department_id'], 'integer'],
        ];
    }


    public function save($post){
        if($this->validate()){
            $message = new Message();
            $message->content = $post['MessageForm']['content'];
            $message->receiver_id = $this->getReceiverId(Yii::$app->user->identity->id);
            $message->sender_id = Yii::$app->user->identity->id;
            $message->department_id = $this->getDepartmentId(Yii::$app->user->identity->id);
            $message->status = Message::STATUS_PENDING;
            $message->created_at = date('Y-m-d h:i:s');
            if($message->save()){
                Yii::$app->session->setFlash('sendMessage', 'Message Send!');
            }
        }
    }

    public function getReceiverId($id){
        $department_id = $this->getDepartmentId($id);
        $departmentEmployee = DepartmentEmployee::find()->where(['department_id' => $department_id]);
        $departmentEmployee->leftJoin(Employee::tableName(),'employees.id = dept_emp.employee_id');
        $departmentEmployee = $departmentEmployee->one();
        return $departmentEmployee->employee_id;
    }

    public function getDepartmentId($id){
        $departmentEmployee = DepartmentEmployee::find()->select('department_id')->where(['employee_id' => $id])->one();
        return $departmentEmployee->department_id;
    }

}
