<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Pelanggan;

/**
 * PelangganSearch represents the model behind the search form about `common\models\Pelanggan`.
 */
class PelangganSearch extends Pelanggan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pelanggan_id', 'pelanggan_provinsi', 'pelanggan_kabupaten', 'pelanggan_kecamatan', 'user_id'], 'integer'],
            [['pelanggan_nama', 'pelanggan_notelpon', 'pelanggan_alamat', 'kode_pos'], 'safe'],
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
        $query = Pelanggan::find();

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
            'pelanggan_id' => $this->pelanggan_id,
            'pelanggan_provinsi' => $this->pelanggan_provinsi,
            'pelanggan_kabupaten' => $this->pelanggan_kabupaten,
            'pelanggan_kecamatan' => $this->pelanggan_kecamatan,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'pelanggan_nama', $this->pelanggan_nama])
            ->andFilterWhere(['like', 'pelanggan_notelpon', $this->pelanggan_notelpon])
            ->andFilterWhere(['like', 'pelanggan_alamat', $this->pelanggan_alamat])
            ->andFilterWhere(['like', 'kode_pos', $this->kode_pos]);

        return $dataProvider;
    }
}
