<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "articolo".
 *
 * @property int $id
 * @property string $descrizione
 * @property int $prezzo
 * @property int $quantita
 * @property int $totale
 * @property int $percentuale
 * @property int $ordine_id
 *
 * @property Ordine $ordine
 */
class Articolo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'articolo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descrizione', 'prezzo', 'totale', 'ordine_id'], 'required'],
            [['prezzo', 'quantita', 'totale', 'percentuale', 'ordine_id'], 'integer'],
            [['descrizione'], 'string', 'max' => 45],
            [['ordine_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ordine::className(), 'targetAttribute' => ['ordine_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descrizione' => 'Descrizione',
            'prezzo' => 'Prezzo',
            'quantita' => 'Quantita',
            'totale' => 'Totale',
            'percentuale' => 'Percentuale',
            'ordine_id' => 'Ordine ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdine()
    {
        return $this->hasOne(Ordine::className(), ['id' => 'ordine_id']);
    }
}
