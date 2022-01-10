<?php

use yii\bootstrap4\Html;

$this->title = 'sent';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel">
    <h1 class="text-center mb-2 bg-info p-3 text-white" >Sent Messages</h1>

    <?= \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{summary}\n{items}\n{pager}",
        'showHeader' => true,
        'options' => array('class' => 'grid-view'),
        'pager' => [
            'class' => 'app\widgets\CustomLinkPager',
            // 'prevPageLabel' => ' < ',
            // 'nextPageLabel' => ' > ',
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
        ],
    ]) ?>


</div>