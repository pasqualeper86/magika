<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cliente".
 *
 * @property int $id
 * @property string $nome
 * @property string $cognome
 * @property string $ragione_sociale
 * @property string $via
 * @property string $citta
 * @property string $p_iva
 * @property int $agente
 *
 * @property Users $agente0
 * @property Ordine[] $ordines
 */
class Cliente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'cognome', 'ragione_sociale', 'via', 'citta', 'p_iva'], 'string', 'max' => 45],
            [['agente'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['agente' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'cognome' => 'Cognome',
            'ragione_sociale' => 'Ragione Sociale',
            'via' => 'Via',
            'citta' => 'Citta',
            'p_iva' => 'P Iva',
            'agente' => 'Agente',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgente()
    {
        return $this->hasOne(Users::className(), ['id' => 'agente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdines()
    {
        return $this->hasMany(Ordine::className(), ['cliente' => 'id']);
    }
}
