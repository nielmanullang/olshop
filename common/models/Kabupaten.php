<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kabupaten".
 *
 * @property integer $kabupaten_id
 * @property integer $provinsi_id
 * @property string $nama
 *
 * @property Pelanggan[] $pelanggans
 */
class Kabupaten extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kabupaten';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kabupaten_id', 'provinsi_id', 'nama'], 'required'],
            [['kabupaten_id', 'provinsi_id'], 'integer'],
            [['nama'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kabupaten_id' => 'Kabupaten ID',
            'provinsi_id' => 'Provinsi ID',
            'nama' => 'Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPelanggans()
    {
        return $this->hasMany(Pelanggan::className(), ['pelanggan_kabupaten' => 'kabupaten_id']);
    }
    
    public static function dropdown()
    {
        static $dropdown;
        if($dropdown === null)
        {
            $models = static::find()->all();
            foreach ($models as $model){
                $dropdown[$model->kabupaten_id] = $model->nama;
            }
        }
        return $dropdown;
    }
}
