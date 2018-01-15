<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Provvigione */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="provvigione-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'documento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'importo')->textInput() ?>

    <?= $form->field($model, 'saldato')->textInput() ?>

    <?= $form->field($model, 'totale_ordine')->textInput() ?>

    <?= $form->field($model, 'percentuale')->textInput() ?>

    <?= $form->field($model, 'data_liquidazione')->textInput() ?>

    <?= $form->field($model, 'commento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ordine_id')->textInput() ?>

    <?= $form->field($model, 'stato')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
