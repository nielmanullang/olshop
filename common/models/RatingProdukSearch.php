<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RatingProduk;

/**
 * RatingProdukSearch represents the model behind the search form about `common\models\RatingProduk`.
 */
class RatingProdukSearch extends RatingProduk
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rating_id', 'produk_id', 'pelanggan_id'], 'integer'],
            [['rating_produk'], 'number'],
            [['komentar'], 'safe'],
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
        $query = RatingProduk::find();

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
            'rating_id' => $this->rating_id,
            'produk_id' => $this->produk_id,
            'pelanggan_id' => $this->pelanggan_id,
            'rating_produk' => $this->rating_produk,
        ]);

        $query->andFilterWhere(['like', 'komentar', $this->komentar]);

        return $dataProvider;
    }
}
