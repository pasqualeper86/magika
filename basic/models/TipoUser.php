<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_user".
 *
 * @property int $ID
 * @property string $Nome
 *
 * @property Utenti[] $utentis
 */
class TipoUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nome'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Nome' => 'Nome',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtentis()
    {
        return $this->hasMany(Utenti::className(), ['tipo_user_ID' => 'ID']);
    }
}
