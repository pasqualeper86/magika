<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\FormRegister;
use app\models\Users;
use yii\web\Session;
use app\models\FormRecoverPass;
use app\models\FormResetPass;
use app\models\User;


class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
   
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'user', 'admin','index','register'],
                'rules' => [
                    [
                        'actions' => ['logout', 'admin','register','index'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserAdmin(Yii::$app->user->identity->id);
                        },
                    ],
                    [
                        'actions' => ['logout', 'user'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                          //Llamada al método que comprueba si es un usuario simple
                          return User::isUserSimple(Yii::$app->user->identity->id);
                        },
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (User::isUserAdmin(Yii::$app->user->identity->id))
           {
            return $this->redirect(["site/admin"]);
           }
           else
           {
            return $this->redirect(["site/user"]);
           }
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
   
           if (User::isUserAdmin(Yii::$app->user->identity->id))
           {
            return $this->redirect(["site/admin"]);
           }
           else
           {
            return $this->redirect(["site/user"]);
           }
        }
 
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
   
            if (User::isUserAdmin(Yii::$app->user->identity->id))
               {
                return $this->redirect(["site/admin"]);
               }
               else
               {
                return $this->redirect(["site/user"]);
               }

        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionUser(){
        return $this->render("user");
    }
    public function actionAdmin(){
        return $this->render("admin");
    }
    private function randKey($str='', $long=0)
    {
        $key = null;
        $str = str_split($str);
        $start = 0;
        $limit = count($str)-1;
        for($x=0; $x<$long; $x++)
        {
            $key .= $str[rand($start, $limit)];
        }
        return $key;
    }
  
 
 public function actionRegister()
 {
      //Creamos la instancia con el model de validación
      $model = new FormRegister;

      //Mostrará un mensaje en la vista cuando el usuario se haya registrado
      $msg = null;

      //Validación mediante ajax
      if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
            {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }

      //Validación cuando el formulario es enviado vía post
      //Esto sucede cuando la validación ajax se ha llevado a cabo correctamente
      //También previene por si el usuario tiene desactivado javascript y la
      //validación mediante ajax no puede ser llevada a cabo
      if ($model->load(Yii::$app->request->post()))
      {
       if($model->validate())
       {
        //Preparamos la consulta para guardar el usuario
        $table = new Users;
        $table->username = $model->username;
        $table->email = $model->email;
        //Encriptamos el password
        $table->password = crypt($model->password, Yii::$app->params["salt"]);
        //Creamos una cookie para autenticar al usuario cuando decida recordar la sesión, esta misma
        //clave será utilizada para activar el usuario
        $table->authKey = $this->randKey("abcdef0123456789", 200);
        //Creamos un token de acceso único para el usuario
        $table->accessToken = $this->randKey("abcdef0123456789", 200);

        //Si el registro es guardado correctamente
        if ($table->insert())
        {
         //Nueva consulta para obtener el id del usuario
         //Para confirmar al usuario se requiere su id y su authKey
         $user = $table->find()->where(["email" => $model->email])->one();
         $id = urlencode($user->id);
         $authKey = urlencode($user->authKey);

         $subject = "Confirmar registro";
         $body = "<h1>Haga click en el siguiente enlace para finalizar tu registro</h1>";
         $body .= "<a href='http://yii.local/index.php?r=site/confirm&id=".$id."&authKey=".$authKey."'>Confirmar</a>";

         //Enviamos el correo
         Yii::$app->mailer->compose()
         ->setTo($user->email)
         ->setFrom([Yii::$app->params["adminEmail"] => Yii::$app->params["title"]])
         ->setSubject($subject)
         ->setHtmlBody($body)
         ->send();

         $model->username = null;
         $model->email = null;
         $model->password = null;
         $model->password_repeat = null;

         $msg = "Enhorabuena, ahora sólo falta que confirmes tu registro en tu cuenta de correo";
        }
        else
        {
         $msg = "Ha ocurrido un error al llevar a cabo tu registro";
        }

       }
       else
       {
        $model->getErrors();
       }
      }
      return $this->render("register", ["model" => $model, "msg" => $msg]);
     }
    
    public function actionRecoverpass()
     {
      //Instancia para validar el formulario
      $model = new FormRecoverPass;

      //Mensaje que será mostrado al usuario en la vista
      $msg = null;

      if ($model->load(Yii::$app->request->post()))
      {
       if ($model->validate())
       {
        //Buscar al usuario a través del email
        $table = Users::find()->where("email=:email", [":email" => $model->email]);

        //Si el usuario existe
        if ($table->count() == 1)
        {
         //Crear variables de sesión para limitar el tiempo de restablecido del password
         //hasta que el navegador se cierre
         $session = new Session;
         $session->open();

         //Esta clave aleatoria se cargará en un campo oculto del formulario de reseteado
         $session["recover"] = $this->randKey("abcdef0123456789", 200);
         $recover = $session["recover"];

         //También almacenaremos el id del usuario en una variable de sesión
         //El id del usuario es requerido para generar la consulta a la tabla users y 
         //restablecer el password del usuario
         $table = Users::find()->where("email=:email", [":email" => $model->email])->one();
         $session["id_recover"] = $table->id;

         //Esta variable contiene un número hexadecimal que será enviado en el correo al usuario 
         //para que lo introduzca en un campo del formulario de reseteado
         //Es guardada en el registro correspondiente de la tabla users
         $verification_code = $this->randKey("abcdef0123456789", 8);
         //Columna verification_code
         $table->verification_code = $verification_code;
         //Guardamos los cambios en la tabla users
         $table->save();

         //Creamos el mensaje que será enviado a la cuenta de correo del usuario
         $subject = "Recuperar password";
         $body = "<p>Copie el siguiente código de verificación para restablecer su password ... ";
         $body .= "<strong>".$verification_code."</strong></p>";
         $body .= "<p><a href='http://yii.local/index.php?r=site/resetpass'>Recuperar password</a></p>";

         //Enviamos el correo
         Yii::$app->mailer->compose()
         ->setTo($model->email)
         ->setFrom([Yii::$app->params["adminEmail"] => Yii::$app->params["title"]])
         ->setSubject($subject)
         ->setHtmlBody($body)
         ->send();

         //Vaciar el campo del formulario
         $model->email = null;

         //Mostrar el mensaje al usuario
         $msg = "Le hemos enviado un mensaje a su cuenta de correo para que pueda resetear su password";
        }
        else //El usuario no existe
        {
         $msg = "Ha ocurrido un error";
        }
       }
       else
       {
        $model->getErrors();
       }
      }
      return $this->render("recoverpass", ["model" => $model, "msg" => $msg]);
     }

     public function actionResetpass()
     {
      //Instancia para validar el formulario
      $model = new FormResetPass;

      //Mensaje que será mostrado al usuario
      $msg = null;

      //Abrimos la sesión
      $session = new Session;
      $session->open();

      //Si no existen las variables de sesión requeridas lo expulsamos a la página de inicio
      if (empty($session["recover"]) || empty($session["id_recover"]))
      {
       return $this->redirect(["site/index"]);
      }
      else
      {

       $recover = $session["recover"];
       //El valor de esta variable de sesión la cargamos en el campo recover del formulario
       $model->recover = $recover;

       //Esta variable contiene el id del usuario que solicitó restablecer el password
       //La utilizaremos para realizar la consulta a la tabla users
       $id_recover = $session["id_recover"];

      }

      //Si el formulario es enviado para resetear el password
      if ($model->load(Yii::$app->request->post()))
      {
       if ($model->validate())
       {
        //Si el valor de la variable de sesión recover es correcta
        if ($recover == $model->recover)
        {
         //Preparamos la consulta para resetear el password, requerimos el email, el id 
         //del usuario que fue guardado en una variable de session y el código de verificación
         //que fue enviado en el correo al usuario y que fue guardado en el registro
         $table = Users::findOne(["email" => $model->email, "id" => $id_recover, "verification_code" => $model->verification_code]);

         //Encriptar el password
         $table->password = crypt($model->password, Yii::$app->params["salt"]);

         //Si la actualización se lleva a cabo correctamente
         if ($table->save())
         {

          //Destruir las variables de sesión
          $session->destroy();

          //Vaciar los campos del formulario
          $model->email = null;
          $model->password = null;
          $model->password_repeat = null;
          $model->recover = null;
          $model->verification_code = null;

          $msg = "Enhorabuena, password reseteado correctamente, redireccionando a la página de login ...";
          $msg .= "<meta http-equiv='refresh' content='5; ".Url::toRoute("site/login")."'>";
         }
         else
         {
          $msg = "Ha ocurrido un error";
         }

        }
        else
        {
         $model->getErrors();
        }
       }
      }

      return $this->render("resetpass", ["model" => $model, "msg" => $msg]);

     }
    
}
