<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rating_toko".
 *
 * @property integer $rating_id
 * @property integer $toko_id
 * @property integer $pelanggan_id
 * @property double $rating_toko
 * @property string $komentar
 *
 * @property Pelanggan $pelanggan
 * @property Toko $toko
 */
class RatingToko extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rating_toko';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['toko_id', 'pelanggan_id'], 'integer'],
            [['rating_toko'], 'number'],
            [['komentar'], 'string', 'max' => 128],
            [['pelanggan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pelanggan::className(), 'targetAttribute' => ['pelanggan_id' => 'pelanggan_id']],
            [['toko_id'], 'exist', 'skipOnError' => true, 'targetClass' => Toko::className(), 'targetAttribute' => ['toko_id' => 'toko_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rating_id' => 'Rating ID',
            'toko_id' => 'Toko ID',
            'pelanggan_id' => 'Pelanggan ID',
            'rating_toko' => 'Rating Toko',
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
    public function getToko()
    {
        return $this->hasOne(Toko::className(), ['toko_id' => 'toko_id']);
    }
}
