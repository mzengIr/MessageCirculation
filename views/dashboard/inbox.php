<?php

use app\models\Employee;
use app\models\Message;
use yii\bootstrap4\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

$this->title = 'inbox';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel">
    <h1 class="text-center mb-2 bg-success p-3 text-white">Inbox Messages</h1>

    <?= \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{summary}\n{items}\n{pager}",
        'showHeader' => true,
        'options' => array('class' => 'grid-view'),
        'pager' => [
            'class' => 'app\widgets\CustomLinkPager',
        ],
        'columns' => [
            'id',
            [
                'attribute' => 'username',
                'value' => 'employee.username',
            ],
            [
                'attribute' => 'ip',
                'value' => 'employee.ip',
            ],
            'content',
            [
                'attribute' => 'status',
                'label' => 'status',
                'format' => 'raw',
                'value' =>  function ($model) {
                    switch ($model->status) {
                        case 1:
                            return '<span class="text-secondary">pending</span>';
                            break;
                        case 2:
                            return '<span class="text-danger">rejected</span>';
                            break;
                        case 10:
                            return 'accepted';
                            break;
                    }
                },

            ],
            [
                'attribute' => 'actions',
                'format' => 'raw',
                'value' => function ($model) {
                    if($model->status === Message::STATUS_PENDING){
                        $a = Html::a('accept', Url::to(['/dashboard/accept', 'id' => $model->id]), ['class' => 'p-1 ml-1 btn btn-outline-success']);
                        $b = Html::a('reject',Url::to(['/dashboard/reject', 'id' => $model->id]), ['class' => 'p-1 ml-1 btn btn-outline-danger']);
                        $c = Html::a('info',Url::to(['/dashboard/info', 'id' => $model->id]), ['class' => 'p-1 ml-1 btn btn-outline-info']);
                        return $a . $b . $c;
                    }
                    return '';
                },
            ],
        ],
    ]) ?>


</div>