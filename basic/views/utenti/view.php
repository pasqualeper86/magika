<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Utenti */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Utentis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="utenti-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'ID' => $model->ID, 'tipo_user_ID' => $model->tipo_user_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'ID' => $model->ID, 'tipo_user_ID' => $model->tipo_user_ID], [
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
            'ID',
            'username',
            'password',
            'email:email',
            'tipo_user_ID',
        ],
    ]) ?>

</div>
