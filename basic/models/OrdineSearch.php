<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ordine;

/**
 * OrdineSearch represents the model behind the search form of `app\models\Ordine`.
 */
class OrdineSearch extends Ordine
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'importo', 'importo_netto', 'cliente', 'stato', 'agente'], 'integer'],
            [['data', 'commento', 'conclusione'], 'safe'],
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
        $query = Ordine::find();

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
            'data' => $this->data,
            'importo' => $this->importo,
            'importo_netto' => $this->importo_netto,
            'cliente' => $this->cliente,
            'stato' => $this->stato,
            'agente' => $this->agente,
        ]);

        $query->andFilterWhere(['like', 'commento', $this->commento])
            ->andFilterWhere(['like', 'conclusione', $this->conclusione]);

        return $dataProvider;
    }
}
