<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "produk".
 *
 * @property integer $produk_id
 * @property integer $kategori_id
 * @property string $produk_nama
 * @property double $produk_harga
 * @property string $produk_berat
 * @property string $produk_kondisi
 * @property string $produk_ongkos_kirim
 * @property integer $produk_stok
 * @property string $produk_diskon
 * @property integer $toko_id
 *
 * @property Pembelian[] $pembelians
 * @property Toko $toko
 * @property Kategori $kategori
 * @property RatingProduk[] $ratingProduks
 */
class Produk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $file;
    public static function tableName()
    {
        return 'produk';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kategori_id', 'produk_stok', 'toko_id'], 'integer'],
            [['file'], 'file'],
            [['produk_nama', 'produk_harga', 'produk_berat', 'produk_kondisi', 'produk_ongkos_kirim'], 'required'],
            [['produk_harga'], 'number'],
            [['produk_kondisi', 'produk_ongkos_kirim', 'produk_diskon'], 'string'],
            [['produk_nama', 'produk_berat'], 'string', 'max' => 64],
            [['toko_id'], 'exist', 'skipOnError' => true, 'targetClass' => Toko::className(), 'targetAttribute' => ['toko_id' => 'toko_id']],
            [['kategori_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kategori::className(), 'targetAttribute' => ['kategori_id' => 'kategori_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'produk_id' => 'Produk ID',
            'kategori_id' => 'Kategori',
            'produk_nama' => 'Nama',
            'produk_harga' => 'Harga',
            'produk_berat' => 'Berat',
            'produk_kondisi' => 'Kondisi',
            'produk_ongkos_kirim' => 'Ongkos Kirim',
            'produk_stok' => 'Stok',
            'produk_diskon' => 'Diskon',
            'toko_id' => 'Toko ID',
            'file'=> 'Gambar Produk',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPembelians()
    {
        return $this->hasMany(Pembelian::className(), ['produk_id' => 'produk_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getToko()
    {
        return $this->hasOne(Toko::className(), ['toko_id' => 'toko_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKategori()
    {
        return $this->hasOne(Kategori::className(), ['kategori_id' => 'kategori_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRatingProduks()
    {
        return $this->hasMany(RatingProduk::className(), ['produk_id' => 'produk_id']);
    }
}
