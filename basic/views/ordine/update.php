<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ordine */

$this->title = 'Update Ordine: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Ordines', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'cliente' => $model->cliente, 'stato' => $model->stato, 'agente' => $model->agente]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ordine-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
