<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Articolo */

$this->title = 'Create Articolo';
$this->params['breadcrumbs'][] = ['label' => 'Articolos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articolo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
