<?php

use app\models\Employee;
use yii\bootstrap4\Html;

$this->title = 'dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel">
    <div> <?= Html::a('inbox', ['/dashboard/inbox'], ['class' => 'p-5 mt-1 btn-block btn btn-outline-success']) ?> </div>
    <div> <?= Html::a('sent', ['/dashboard/sent'], ['class' => 'p-5 mt-3 btn-block btn btn-outline-info']) ?> </div>
    <div> <?php echo Employee::getType(Yii::$app->user->identity->id) === Employee::TYPE_EMPLOYEE ? Html::a('NewMessage', ['/dashboard/create'], ['class' => 'p-5 mt-3 btn-block btn btn-outline-secondary']) : '';?> </div>
</div>