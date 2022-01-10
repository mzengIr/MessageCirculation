<?php

namespace app\models;

use Exception;
use yii\db\ActiveRecord;
use Yii;
use app\models\Employee;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;

class Message extends ActiveRecord 
{

    const STATUS_ACCEPTEED = 10;
    const STATUS_PENDING = 1;
    const STATUS_REJECTED = 2;

    public static function tableName() {
        return '{{%messages}}';
    }

    
    public function rules() {
        return [
            [['content','receiver_id','sender_id','department_id','status'], 'required'],
            [['receiver_id','sender_id','department_id'], 'integer'],
        ];
    }

  
    public function getMessages() {
        $messages = Message::find()->where(['receiver_id'=> Yii::$app->user->identity->id]);
        return $messages;
    }

    public function getEmployee(){
        return $this->hasOne( Employee::class,['id' => 'receiver_id']);
    }

    public static function changeStatus($id , $status){
        $message = Message::findOne($id);
        $message->status = $status;
        return $message->save();
    }
    
}
