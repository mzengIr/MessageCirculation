<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'create message';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel">
    <h1 class="text-center mb-5 bg-info p-3 text-white" >Create Message</h1>
    <?php $form = ActiveForm::begin([
        'id' => 'creaeteMessage',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label'],
            'inputOptions' => ['class' => 'col-lg-6 form-control'],
            'errorOptions' => ['class' => 'col-lg-4 invalid-feedback'],
        ],
    ]); ?>

        <?= $form->field($model, 'content')->textarea(['autofocus' => true]) ?>

        <div class="form-group mt-5">
            <div class="offset-lg-12 col-12">
                <?= Html::submitButton('Send Message', ['class' => 'btn-block btn btn-outline-success', 'name' => 'submit-department']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
    <?php if (Yii::$app->session->hasFlash('sendMessage')){ ?>
    <div class="alert alert-success">
         <?php echo Yii::$app->session->getFlash('sendMessage'); ?>
    </div>
    <?php } ?>
  
</div>
