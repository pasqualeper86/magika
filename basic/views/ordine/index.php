<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\daterange\DateRangePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ordines';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ordine-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ordine', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'data',
            'commento',
            'conclusione',
            'importo',
            //'importo_netto',
            //'cliente',
            //'stato',
            //'agente',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
<?php echo '<label class="control-label">Date Range</label>';
echo '<div class="drp-container">';
echo DateRangePicker::widget([
    'name'=>'date_range_2',
    'presetDropdown'=>true,
    'hideInput'=>true
]);
echo '</div>';
?>