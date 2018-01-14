<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "provvigione".
 *
 * @property int $id
 * @property string $documento
 * @property int $importo
 * @property int $saldato
 * @property int $totale_ordine
 * @property int $percentuale
 * @property string $data_liquidazione
 * @property string $commento
 * @property int $ordine_id
 * @property int $stato
 *
 * @property Ordine $ordine
 * @property StatoProvvigione $stato0
 */
class Provvigione extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provvigione';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['importo', 'saldato', 'totale_ordine', 'percentuale', 'ordine_id', 'stato'], 'integer'],
            [['data_liquidazione'], 'safe'],
            [['ordine_id', 'stato'], 'required'],
            [['documento', 'commento'], 'string', 'max' => 45],
            [['ordine_id'], 'unique'],
            [['ordine_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ordine::className(), 'targetAttribute' => ['ordine_id' => 'id']],
            [['stato'], 'exist', 'skipOnError' => true, 'targetClass' => StatoProvvigione::className(), 'targetAttribute' => ['stato' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'documento' => 'Documento',
            'importo' => 'Importo',
            'saldato' => 'Saldato',
            'totale_ordine' => 'Totale Ordine',
            'percentuale' => 'Percentuale',
            'data_liquidazione' => 'Data Liquidazione',
            'commento' => 'Commento',
            'ordine_id' => 'Ordine ID',
            'stato' => 'Stato',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdine()
    {
        return $this->hasOne(Ordine::className(), ['id' => 'ordine_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStato0()
    {
        return $this->hasOne(StatoProvvigione::className(), ['id' => 'stato']);
    }
}
