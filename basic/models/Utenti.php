<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "utenti".
 *
 * @property int $ID
 * @property string $username
 * @property string $password
 * @property string $email
 * @property int $tipo_user_ID
 *
 * @property Agente $agente
 * @property TipoUser $tipoUser
 */
class Utenti extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'utenti';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo_user_ID'], 'required'],
            [['tipo_user_ID'], 'integer'],
            [['username', 'password', 'email'], 'string', 'max' => 45],
            [['tipo_user_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TipoUser::className(), 'targetAttribute' => ['tipo_user_ID' => 'ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'tipo_user_ID' => 'Tipo User  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgente()
    {
        return $this->hasOne(Agente::className(), ['ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoUser()
    {
        return $this->hasOne(TipoUser::className(), ['ID' => 'tipo_user_ID']);
    }
}
