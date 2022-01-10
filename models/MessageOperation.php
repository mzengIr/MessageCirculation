<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;
use app\models\Employee;


class MessageOperation extends ActiveRecord 
{

    public static function tableName() {
        return '{{%message_operations}}';
    }

    
    public function rules() {
        return [
            [['message_id','employee_id','status'], 'required'],
        ];
    }

    public static function saveMessageOperation($id){
        $messageOperation = new MessageOperation();
        $messageOperation->message_id = $id;
        $messageOperation->employee_id = Yii::$app->user->identity->id;
        $messageOperation->status = Message::STATUS_REJECTED;
        $messageOperation->created_at =  date('Y-m-d h:i:s');
        return $messageOperation->save();
    }
    
}
