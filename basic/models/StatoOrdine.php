<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stato_ordine".
 *
 * @property int $id
 * @property string $nome
 * @property string $colore
 * @property string $icon
 *
 * @property Ordine[] $ordines
 */
class StatoOrdine extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stato_ordine';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'colore', 'icon'], 'string', 'max' => 45],
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
            'colore' => 'Colore',
            'icon' => 'Icon',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdines()
    {
        return $this->hasMany(Ordine::className(), ['stato' => 'id']);
    }
}
