<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Ordine */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ordines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ordine-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'cliente' => $model->cliente, 'stato' => $model->stato, 'agente' => $model->agente], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id, 'cliente' => $model->cliente, 'stato' => $model->stato, 'agente' => $model->agente], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'data',
            'commento',
            'conclusione',
            'importo',
            'importo_netto',
            'cliente',
            'stato',
            'agente',
        ],
    ]) ?>

</div>
