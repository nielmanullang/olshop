<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Produk;

/**
 * ProdukSearch represents the model behind the search form about `common\models\Produk`.
 */
class ProdukSearch extends Produk
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['produk_id', 'kategori_id', 'produk_stok', 'toko_id'], 'integer'],
            [['produk_nama', 'produk_berat', 'produk_kondisi', 'produk_ongkos_kirim', 'produk_diskon'], 'safe'],
            [['produk_harga'], 'number'],
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
        $query = Produk::find();

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
            'produk_id' => $this->produk_id,
            'kategori_id' => $this->kategori_id,
            'produk_harga' => $this->produk_harga,
            'produk_stok' => $this->produk_stok,
            'toko_id' => $this->toko_id,
        ]);

        $query->andFilterWhere(['like', 'produk_nama', $this->produk_nama])
            ->andFilterWhere(['like', 'produk_berat', $this->produk_berat])
            ->andFilterWhere(['like', 'produk_kondisi', $this->produk_kondisi])
            ->andFilterWhere(['like', 'produk_ongkos_kirim', $this->produk_ongkos_kirim])
            ->andFilterWhere(['like', 'produk_diskon', $this->produk_diskon]);

        return $dataProvider;
    }
}
