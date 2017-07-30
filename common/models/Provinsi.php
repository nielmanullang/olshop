<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "provinsi".
 *
 * @property integer $provinsi_id
 * @property string $nama
 *
 * @property Pelanggan[] $pelanggans
 */
class Provinsi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provinsi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provinsi_id', 'nama'], 'required'],
            [['provinsi_id'], 'integer'],
            [['nama'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'provinsi_id' => 'Provinsi ID',
            'nama' => 'Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPelanggans()
    {
        return $this->hasMany(Pelanggan::className(), ['pelanggan_provinsi' => 'provinsi_id']);
    }
    
    public static function dropdown()
    {
        static $dropdown;
        if($dropdown === null)
        {
            $models = static::find()->all();
            foreach ($models as $model){
                $dropdown[$model->provinsi_id] = $model->nama;
            }
        }
        return $dropdown;
    }
}
