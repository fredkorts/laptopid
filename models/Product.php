<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $mfr
 * @property string $model
 * @property string $price
 * @property string $cut_price
 * @property integer $stock
 * @property integer $active
 * @property string $description
 * @property integer $highlighted
 *
 * @property ProductField[] $productFields
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mfr', 'model', 'price', 'cut_price', 'stock', 'active', 'description'], 'required'],
            [['price', 'cut_price'], 'number'],
            [['stock', 'active', 'highlighted'], 'integer'],
            [['description'], 'string'],
            [['mfr', 'model'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'mfr' => Yii::t('app', 'Mfr'),
            'model' => Yii::t('app', 'Model'),
            'price' => Yii::t('app', 'Price'),
            'cut_price' => Yii::t('app', 'Cut Price'),
            'stock' => Yii::t('app', 'Stock'),
            'active' => Yii::t('app', 'Active'),
            'description' => Yii::t('app', 'Description'),
            'highlighted' => Yii::t('app', 'Highlighted'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductFields()
    {
        return $this->hasMany(ProductField::className(), ['product_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }
}
