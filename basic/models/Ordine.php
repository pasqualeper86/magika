<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ordine".
 *
 * @property int $id
 * @property string $data
 * @property string $commento
 * @property string $conclusione
 * @property int $importo
 * @property int $importo_netto
 * @property int $cliente
 * @property int $stato
 * @property int $agente
 *
 * @property Articolo[] $articolos
 * @property Cliente $cliente0
 * @property StatoOrdine $stato0
 * @property Users $agente0
 * @property Provvigione $provvigione
 */
class Ordine extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ordine';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data'], 'safe'],
            [['importo', 'importo_netto', 'cliente', 'stato', 'agente'], 'integer'],
            [['cliente', 'stato', 'agente'], 'required'],
            [['commento', 'conclusione'], 'string', 'max' => 45],
            [['cliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['cliente' => 'id']],
            [['stato'], 'exist', 'skipOnError' => true, 'targetClass' => StatoOrdine::className(), 'targetAttribute' => ['stato' => 'id']],
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
            'data' => 'Data',
            'commento' => 'Commento',
            'conclusione' => 'Conclusione',
            'importo' => 'Importo',
            'importo_netto' => 'Importo Netto',
            'cliente' => 'Cliente',
            'stato' => 'Stato',
            'agente' => 'Agente',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticolos()
    {
        return $this->hasMany(Articolo::className(), ['ordine_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCliente0()
    {
        return $this->hasOne(Cliente::className(), ['id' => 'cliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStato0()
    {
        return $this->hasOne(StatoOrdine::className(), ['id' => 'stato']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgente0()
    {
        return $this->hasOne(Users::className(), ['id' => 'agente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvvigione()
    {
        return $this->hasOne(Provvigione::className(), ['ordine_id' => 'id']);
    }
}
