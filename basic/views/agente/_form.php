<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Agente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agente-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID')->dropDownList($items,['readonly' => true]) ?>
    <?= $form->field($model, 'Nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Cognome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IBAN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Commisione')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
