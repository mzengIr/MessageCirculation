<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="text-center mb-2 bg-warning p-5 text-dark">welcome to Message Circulation!</h1>
        <?php if (!Yii::$app->user->isGuest) { ?>
            <?php if (Yii::$app->user->can('admin')) { ?>
                <div> <?= Html::a('Panel', ['/panel'], ['class' => 'p-5 mt-1 btn-block btn bg-danger text-white']) ?> </div>
            <?php } else { ?>
                <div> <?= Html::a('Dashboard', ['/dashboard'], ['class' => 'p-5 mt-1 btn-block btn bg-danger text-white']) ?> </div>
            <?php } ?>
        <?php } ?>
    </div>

</div>