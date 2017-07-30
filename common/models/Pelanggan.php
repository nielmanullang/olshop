<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pelanggan".
 *
 * @property integer $pelanggan_id
 * @property string $pelanggan_nama
 * @property string $pelanggan_notelpon
 * @property integer $pelanggan_provinsi
 * @property integer $pelanggan_kabupaten
 * @property integer $pelanggan_kecamatan
 * @property string $pelanggan_alamat
 * @property string $kode_pos
 * @property integer $user_id
 *
 * @property User $user
 * @property Provinsi $pelangganProvinsi
 * @property Kabupaten $pelangganKabupaten
 * @property Kecamatan $pelangganKecamatan
 * @property Pembelian[] $pembelians
 * @property RatingProduk[] $ratingProduks
 * @property RatingToko[] $ratingTokos
 * @property Toko[] $tokos
 */
class Pelanggan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pelanggan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pelanggan_nama'], 'required'],
            [['pelanggan_provinsi', 'pelanggan_kabupaten', 'pelanggan_kecamatan', 'user_id'], 'integer'],
            [['pelanggan_nama', 'pelanggan_notelpon', 'pelanggan_alamat'], 'string', 'max' => 64],
            [['kode_pos'], 'string', 'max' => 6],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['pelanggan_provinsi'], 'exist', 'skipOnError' => true, 'targetClass' => Provinsi::className(), 'targetAttribute' => ['pelanggan_provinsi' => 'provinsi_id']],
            [['pelanggan_kabupaten'], 'exist', 'skipOnError' => true, 'targetClass' => Kabupaten::className(), 'targetAttribute' => ['pelanggan_kabupaten' => 'kabupaten_id']],
            [['pelanggan_kecamatan'], 'exist', 'skipOnError' => true, 'targetClass' => Kecamatan::className(), 'targetAttribute' => ['pelanggan_kecamatan' => 'kecamatan_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pelanggan_id' => 'Pelanggan ID',
            'pelanggan_nama' => 'Pelanggan Nama',
            'pelanggan_notelpon' => 'Pelanggan Notelpon',
            'pelanggan_provinsi' => 'Pelanggan Provinsi',
            'pelanggan_kabupaten' => 'Pelanggan Kabupaten',
            'pelanggan_kecamatan' => 'Pelanggan Kecamatan',
            'pelanggan_alamat' => 'Pelanggan Alamat',
            'kode_pos' => 'Kode Pos',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPelangganProvinsi()
    {
        return $this->hasOne(Provinsi::className(), ['provinsi_id' => 'pelanggan_provinsi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPelangganKabupaten()
    {
        return $this->hasOne(Kabupaten::className(), ['kabupaten_id' => 'pelanggan_kabupaten']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPelangganKecamatan()
    {
        return $this->hasOne(Kecamatan::className(), ['kecamatan_id' => 'pelanggan_kecamatan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPembelians()
    {
        return $this->hasMany(Pembelian::className(), ['pelanggan_id' => 'pelanggan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRatingProduks()
    {
        return $this->hasMany(RatingProduk::className(), ['pelanggan_id' => 'pelanggan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRatingTokos()
    {
        return $this->hasMany(RatingToko::className(), ['pelanggan_id' => 'pelanggan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTokos()
    {
        return $this->hasMany(Toko::className(), ['pelanggan_id' => 'pelanggan_id']);
    }
}
