<?php

namespace app\models;

use app\controllers\DashboardController;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;

class MessageSearch extends Message 
{
    public $username;
    public $ip;

    public function rules() {
        return [
            [['content'],'string'],
            [['username','ip'], 'safe']
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params,$type)
    {
        $query = Message::find()->joinWith('employee');
        $type == DashboardController::SENT ? $query->where(['messages.sender_id' => Yii::$app->user->identity->id]) : $query->where(['messages.receiver_id' => Yii::$app->user->identity->id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);
        
        $dataProvider->sort->attributes['username'] = [
            'asc' => ['employees.username' => SORT_ASC],
            'desc' => ['employees.username' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['ip'] = [
            'asc' => ['employees.ip' => SORT_ASC],
            'desc' => ['employees.ip' => SORT_DESC],
        ];

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'messages.content', $params['MessageSearch']['content']]);
        $query->andFilterWhere(['like', 'username', $params['MessageSearch']['username']]);
        $query->andFilterWhere(['like', 'ip', $params['MessageSearch']['ip']]);

        return $dataProvider;
    }

    
}
