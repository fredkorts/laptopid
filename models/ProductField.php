<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_field".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $field_id
 *
 * @property Product $product
 * @property Field $field
 */
class ProductField extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'field_id'], 'required'],
            [['product_id', 'field_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Toode'),
            'field_id' => Yii::t('app', 'Komponent'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getField()
    {
        return $this->hasOne(Field::className(), ['id' => 'field_id']);
    }

    /**
     * @inheritdoc
     * @return ProductFieldQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductFieldQuery(get_called_class());
    }
}
