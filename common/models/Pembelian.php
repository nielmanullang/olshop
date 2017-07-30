<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pembelian".
 *
 * @property integer $pembelian_id
 * @property integer $produk_id
 * @property string $waktu_pembelian
 * @property integer $pelanggan_id
 *
 * @property Pelanggan $pelanggan
 * @property Produk $produk
 */
class Pembelian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pembelian';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['produk_id', 'pelanggan_id'], 'integer'],
            [['waktu_pembelian'], 'safe'],
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
            'pembelian_id' => 'Pembelian ID',
            'produk_id' => 'Produk ID',
            'waktu_pembelian' => 'Waktu Pembelian',
            'pelanggan_id' => 'Pelanggan ID',
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
