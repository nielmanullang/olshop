<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kecamatan".
 *
 * @property integer $kecamatan_id
 * @property integer $kabupaten_id
 * @property string $nama
 *
 * @property Pelanggan[] $pelanggans
 */
class Kecamatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kecamatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kecamatan_id', 'kabupaten_id', 'nama'], 'required'],
            [['kecamatan_id', 'kabupaten_id'], 'integer'],
            [['nama'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kecamatan_id' => 'Kecamatan ID',
            'kabupaten_id' => 'Kabupaten ID',
            'nama' => 'Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPelanggans()
    {
        return $this->hasMany(Pelanggan::className(), ['pelanggan_kecamatan' => 'kecamatan_id']);
    }
    
    public static function dropdown()
    {
        static $dropdown;
        if($dropdown === null)
        {
            $models = static::find()->all();
            foreach ($models as $model){
                $dropdown[$model->kecamatan_id] = $model->nama;
            }
        }
        return $dropdown;
    }
}
