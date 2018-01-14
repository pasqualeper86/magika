<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UtentiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Utenti';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="utenti-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Utenti', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'username',
            'password',
            'email:email',
            'tipo_user_ID',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
