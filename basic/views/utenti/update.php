<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Utenti */

$this->title = 'Update Utenti: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Utentis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'ID' => $model->ID, 'tipo_user_ID' => $model->tipo_user_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="utenti-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
