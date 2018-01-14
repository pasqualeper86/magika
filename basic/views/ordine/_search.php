<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrdineSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ordine-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'data') ?>

    <?= $form->field($model, 'commento') ?>

    <?= $form->field($model, 'conclusione') ?>

    <?= $form->field($model, 'importo') ?>

    <?php // echo $form->field($model, 'importo_netto') ?>

    <?php // echo $form->field($model, 'cliente') ?>

    <?php // echo $form->field($model, 'stato') ?>

    <?php // echo $form->field($model, 'agente') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
