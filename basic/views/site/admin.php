<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets;
?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-home"></span> Menu Inicial</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                          <a href="#" class="btn btn-danger btn-lg" role="button"><span class="glyphicon glyphicon-trash"></span> <br/>Remover</a>
                          <a href="#" class="btn btn-warning btn-lg" role="button"><span class="glyphicon glyphicon-refresh"></span> <br/>Atualizar</a>
                          <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-folder-open"></span> <br/>Localizar</a>
                          <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-pencil"></span> <br/>Anotações</a>
                        </div>
                        <div class="col-xs-6 col-md-6">
                          <a href="#" class="btn btn-success btn-lg" role="button"><span class="glyphicon glyphicon-user"></span> <br/>Alunos</a>
                          <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-user"></span> <br/>Servidores</a>
                          <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-picture"></span> <br/>Photos</a>
                          <a href="#" class="btn btn-danger btn-lg" role="button"><span class="glyphicon glyphicon-off"></span> <br/>Sair</a>
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