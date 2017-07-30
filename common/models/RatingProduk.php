<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rating_produk".
 *
 * @property integer $rating_id
 * @property integer $produk_id
 * @property integer $pelanggan_id
 * @property double $rating_produk
 * @property string $komentar
 *
 * @property Pelanggan $pelanggan
 * @property Produk $produk
 */
class RatingProduk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rating_produk';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['produk_id', 'pelanggan_id'], 'integer'],
            [['rating_produk'], 'number'],
            [['komentar'], 'string', 'max' => 128],
            [['pelanggan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pelanggan::className(), 'targetAttribute' => ['pelanggan_id' => 'pelanggan_id']],
            [['produk_id'], 'exist', 'skipOnError' => true, 'targetClass' => Produk::className(), 'targetAttribute' => ['produk_id' => 'produk_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rating_id' => 'Rating ID',
            'produk_id' => 'Produk ID',
            'pelanggan_id' => 'Pelanggan ID',
            'rating_produk' => 'Rating Produk',
            'komentar' => 'Komentar',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPelanggan()
    {
        return $this->hasOne(Pelanggan::className(), ['pelanggan_id' => 'pelanggan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduk()
    {
        return $this->hasOne(Produk::className(), ['produk_id' => 'produk_id']);
    }
}
