<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "toko".
 *
 * @property integer $toko_id
 * @property string $toko_nama
 * @property string $toko_slogan
 * @property string $toko_deskripsi
 * @property string $toko_alamat
 * @property integer $pelanggan_id
 *
 * @property Produk[] $produks
 * @property RatingToko[] $ratingTokos
 * @property Pelanggan $pelanggan
 */
class Toko extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'toko';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['toko_nama', 'toko_slogan', 'toko_deskripsi', 'toko_alamat'], 'required'],
            [['toko_deskripsi'], 'string'],
            [['pelanggan_id'], 'integer'],
            [['toko_nama'], 'string', 'max' => 32],
            [['toko_slogan', 'toko_alamat'], 'string', 'max' => 128],
            [['pelanggan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pelanggan::className(), 'targetAttribute' => ['pelanggan_id' => 'pelanggan_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'toko_id' => 'Toko ID',
            'toko_nama' => 'Toko',
            'toko_slogan' => 'Toko Slogan',
            'toko_deskripsi' => 'Toko Deskripsi',
            'toko_alamat' => 'Toko Alamat',
            'pelanggan_id' => 'Pelanggan ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduks()
    {
        return $this->hasMany(Produk::className(), ['toko_id' => 'toko_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRatingTokos()
    {
        return $this->hasMany(RatingToko::className(), ['toko_id' => 'toko_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPelanggan()
    {
        return $this->hasOne(Pelanggan::className(), ['pelanggan_id' => 'pelanggan_id']);
    }
}
