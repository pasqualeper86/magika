<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ordine */

$this->title = 'Create Ordine';
$this->params['breadcrumbs'][] = ['label' => 'Ordines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ordine-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $modelCustomer,
        'modelsAddress'=>$modelsAddress
    ]) ?>

</div>
