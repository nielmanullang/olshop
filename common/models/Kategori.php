<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kategori".
 *
 * @property integer $kategori_id
 * @property string $kategori_name
 *
 * @property Produk[] $produks
 */
class Kategori extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kategori';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kategori_name'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kategori_id' => 'Kategori ID',
            'kategori_name' => 'Kategori',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduks()
    {
        return $this->hasMany(Produk::className(), ['kategori_id' => 'kategori_id']);
    }
}
