<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\jui\DatePicker;

$this->title = 'SignUp';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-SignUp">
    <h1 class="text-center mb-5 bg-info p-3 text-white" >SignUp</h1>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-2 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-6 invalid-feedback'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'family')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'nationalCode')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'birthDate')->widget(DatePicker::className(), [
                'options' => ['class' => 'col-lg-3 form-control'],
        ]) ?>
        <?= $form->field($model, 'password')->passwordInput() ?>

        <div class="form-group">
            <div class="offset-lg-12 col-lg-12">
                <?= Html::submitButton('SignUp', ['class' => 'btn-block btn btn-outline-info', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>
