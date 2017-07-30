<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Toko;

/**
 * TokoSearch represents the model behind the search form about `common\models\Toko`.
 */
class TokoSearch extends Toko
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['toko_id', 'pelanggan_id'], 'integer'],
            [['toko_nama', 'toko_slogan', 'toko_deskripsi', 'toko_alamat'], 'safe'],
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
        $query = Toko::find();

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
            'toko_id' => $this->toko_id,
            'pelanggan_id' => $this->pelanggan_id,
        ]);

        $query->andFilterWhere(['like', 'toko_nama', $this->toko_nama])
            ->andFilterWhere(['like', 'toko_slogan', $this->toko_slogan])
            ->andFilterWhere(['like', 'toko_deskripsi', $this->toko_deskripsi])
            ->andFilterWhere(['like', 'toko_alamat', $this->toko_alamat]);

        return $dataProvider;
    }
}
