<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
 
<h3><?= $msg ?></h3>

<?php $form = ActiveForm::begin([
    'method' => 'post',
    'enableClientValidation' => true,
]);
?>
 
<?php $form->end() ?>
<div class="login-body">
    <article class="container-login center-block">
		<section>
			<ul id="top-bar" class="nav nav-tabs nav-justified">
				<li ><a href="<?php echo  Url::to(['site/login']);?>">Accesso</a></li>
				<li class="active"><a href="<?php echo  Url::to(['site/recoverpass']);?>">Password dimenticata</a></li>
			</ul>
            <div class="tab-content tabs-login col-lg-12 col-md-12 col-sm-12 cols-xs-12">
                <div id="login-access" class="tab-pane fade active in">
                    <h2><i class="glyphicon glyphicon-log-in"></i> Recupera</h2>	
                    <?php $form = ActiveForm::begin([
                        'method' => 'post',
                        'enableClientValidation' => true,
                    ]);
                    ?>
                        <div class="form-group ">
                            <?= $form->field($model, 'email')->textInput(['autofocus' => true])->label('Email',['class'=>'sr-only']) ?>
                        </div>
                        <div class="form-group">
                            <?= Html::submitButton('Recupera', ['class' => 'btn btn-lg btn-primary', 'name' => 'login-button']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </section>
	</article>
</div>

<style>
    @import url("http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700");

    body {
        font-family: Open Sans;
        font-size: 14px;
        line-height: 1.42857;
        background: #333333;
        height: 350px;
        padding: 0;
        margin: 0;
    }
    .container-login {
        min-height: 0;
        width: 480px;
        color: #333333;
        margin-top: 40px;
        padding: 0;
    }
    .center-block {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    .container-login > section {
        margin-left: 0;
        margin-right: 0;
        padding-bottom: 10px;
    }
    #top-bar {
        display: inherit;
    }
    .nav-tabs.nav-justified {
        border-bottom: 0 none;
        width: 100%;
    }
    .nav-tabs.nav-justified > li {
        display: table-cell;
        width: 1%;
        float: none;
    }
    .container-login .nav-tabs.nav-justified > li > a,
    .container-login .nav-tabs.nav-justified > li > a:hover,
    .container-login .nav-tabs.nav-justified > li > a:focus {
        background: #ea533f;
        border: medium none;
        color: #ffffff;
        margin-bottom: 0;
        margin-right: 0;
        border-radius: 0;
    }
    .container-login .nav-tabs.nav-justified > .active > a,
    .container-login .nav-tabs.nav-justified > .active > a:hover,
    .container-login .nav-tabs.nav-justified > .active > a:focus {
        background: #ffffff;
        color: #333333;
    }
    .container-login .nav-tabs.nav-justified > li > a:hover,
    .container-login .nav-tabs.nav-justified > li > a:focus {
        background: #de2f18;
    }
    .tabs-login {
        background: #ffffff;
        border: medium none;
        margin-top: -1px;
        padding: 10px 30px;
    }
    .container-login h2 {
        color: #ea533f;
    }
    .form-control {
        background-color: #ffffff;
        background-image: none;
        border: 1px solid #999999;
        border-radius: 0;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
        color: #333333;
        display: block;
        font-size: 14px;
        height: 34px;
        line-height: 1.42857;
        padding: 6px 12px;
        transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
        width: 100%;
    }
    .container-login .checkbox {
        margin-top: -15px;
    }
    .container-login button {
        background-color: #ea533f;
        border-color: #e73e28;
        color: #ffffff;
        border-radius: 0;
        font-size: 18px;
        line-height: 1.33;
        padding: 10px 16px;
        width: 100%;
    }
    .container-login button:hover,
    .container-login button:focus {
        background: #de2f18;
        border-color: #be2815;
    }
    .col-lg-3{
        width:100%;
    }

    .footer{
            display: none;
    }
    .col-sm-6.col-sm-offset-3{
        margin:0;
    }
    a{
        cursor: pointer;
    }
</style>