<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stato_provvigione".
 *
 * @property int $id
 * @property string $nome
 * @property string $colore
 * @property string $icon
 *
 * @property Provvigione[] $provvigiones
 */
class StatoProvvigione extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stato_provvigione';
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
    public function getProvvigiones()
    {
        return $this->hasMany(Provvigione::className(), ['stato' => 'id']);
    }
}
