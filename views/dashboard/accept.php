<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'panel';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel">

<h1 class="text-center mb-2 bg-success p-3 text-white">Accept Messages</h1>  

    <?php $form = ActiveForm::begin([
        'id' => 'acceptMessage',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-2 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-6 invalid-feedback'],
        ],
    ]); ?>


        <?= $form->field($acceptForm, 'manager')->dropDownList($acceptForm->managers,
            [
                'class'=>'col-lg-3 chosen-select input-md required',              
            ] 
            )->label("Add Manager");  ?>

        <div class="form-group">
            <div class="offset-lg-1 col-lg-11">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-secondary', 'name' => 'submit-department']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?> 
</div>
