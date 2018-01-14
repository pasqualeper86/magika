<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Articolo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="articolo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descrizione')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantita')->textInput() ?>

    <?= $form->field($model, 'percentuale')->textInput() ?>

    <?= $form->field($model, 'ordine_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
