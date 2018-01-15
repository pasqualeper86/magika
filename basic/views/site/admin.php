<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets;
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-home"></span> Menu Iniziale</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-8 col-md-8">
                          <a href="<?= Url::to(['users/index']);?>" class="btn btn-success btn-lg" role="button"><span class="glyphicon glyphicon-briefcase"></span> <br/>Agenti</a>
                          <a href="<?= Url::to(['cliente/index']);?>" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-user"></span> <br/>Clienti</a>
                          <a href="<?= Url::to(['ordine/index']);?>" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-shopping-cart"></span> <br/>Ordini</a>
                          <a href="<?= Url::to(['provvigione/index']);?>" class="btn btn-danger btn-lg" role="button"><span class="glyphicon glyphicon-usd"></span> <br/>Provvigioni</a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<style>
body { padding-top:20px; }
.panel-body .btn:not(.btn-block) { width:120px;margin-bottom:10px; }
</style>