<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProvvigioneSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Provvigiones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="provvigione-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Provvigione', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'documento',
            'importo',
            'saldato',
            'totale_ordine',
            //'percentuale',
            //'data_liquidazione',
            //'commento',
            //'ordine_id',
            //'stato',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
