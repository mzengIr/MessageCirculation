<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Employee;

class AcceptForm extends Model
{
    public $managers;
    public $manager;

    public function rules()
    {
        return [
            [['manager'], 'required'],
        ];
    }

    public function __construct()
    {
        $this->managers = Employee::getManagers();
    }

    public function save($post,$id){
        if($this->validate()){
            $message = Message::findOne($id);
            $message->status = Message::STATUS_ACCEPTEED;
            $message->sender_id = Yii::$app->user->identity->id;
            $message->receiver_id = $post['AcceptForm']['manager'];
            $message->updated_at =  date('Y-m-d h:i:s');
            return $message->save();
        }
    }


}
