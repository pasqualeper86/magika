<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Provvigione;

/**
 * ProvvigioneSearch represents the model behind the search form of `app\models\Provvigione`.
 */
class ProvvigioneSearch extends Provvigione
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'importo', 'saldato', 'totale_ordine', 'percentuale', 'ordine_id', 'stato'], 'integer'],
            [['documento', 'data_liquidazione', 'commento'], 'safe'],
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
        $query = Provvigione::find();

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
            'importo' => $this->importo,
            'saldato' => $this->saldato,
            'totale_ordine' => $this->totale_ordine,
            'percentuale' => $this->percentuale,
            'data_liquidazione' => $this->data_liquidazione,
            'ordine_id' => $this->ordine_id,
            'stato' => $this->stato,
        ]);

        $query->andFilterWhere(['like', 'documento', $this->documento])
            ->andFilterWhere(['like', 'commento', $this->commento]);

        return $dataProvider;
    }
}
