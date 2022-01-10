<?php

namespace app\models;

use Exception;
use yii\db\ActiveRecord;
use Yii;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;

class Department extends ActiveRecord 
{

    public static function tableName() {
        return '{{%departments}}';
    }

    
    public function rules() {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 64],
        ];
    }

  
    public function getId() {
        return $this->id;
    }

    
}
