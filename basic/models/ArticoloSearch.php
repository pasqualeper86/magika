<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Articolo;

/**
 * ArticoloSearch represents the model behind the search form of `app\models\Articolo`.
 */
class ArticoloSearch extends Articolo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'quantita', 'percentuale', 'ordine_id'], 'integer'],
            [['descrizione'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Articolo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'quantita' => $this->quantita,
            'percentuale' => $this->percentuale,
            'ordine_id' => $this->ordine_id,
        ]);

        $query->andFilterWhere(['like', 'descrizione', $this->descrizione]);

        return $dataProvider;
    }
}
