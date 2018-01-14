<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Utenti */

$this->title = 'Create Utenti';
$this->params['breadcrumbs'][] = ['label' => 'Utentis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="utenti-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
