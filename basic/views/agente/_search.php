<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AgenteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agente-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'Nome') ?>

    <?= $form->field($model, 'Cognome') ?>

    <?= $form->field($model, 'Telefono') ?>

    <?= $form->field($model, 'Email') ?>

    <?php // echo $form->field($model, 'IBAN') ?>

    <?php // echo $form->field($model, 'Commisione') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
