<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Pembelian;

/**
 * PembelianSearch represents the model behind the search form about `common\models\Pembelian`.
 */
class PembelianSearch extends Pembelian
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pembelian_id', 'produk_id', 'pelanggan_id'], 'integer'],
            [['waktu_pembelian'], 'safe'],
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
        $query = Pembelian::find();

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
            'pembelian_id' => $this->pembelian_id,
            'produk_id' => $this->produk_id,
            'waktu_pembelian' => $this->waktu_pembelian,
            'pelanggan_id' => $this->pelanggan_id,
        ]);

        return $dataProvider;
    }
}
