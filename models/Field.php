<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "field".
 *
 * @property integer $id
 * @property integer $type_id
 * @property string $name
 * @property string $model
 * @property integer $value
 * @property string $price
 *
 * @property FieldType $type
 * @property ProductField[] $productFields
 */
class Field extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id', 'name', 'model', 'value', 'unit', 'price'], 'required'],
            [['type_id', 'value'], 'integer'],
            [['price'], 'number'],
            [['name', 'model'], 'string', 'max' => 40],
			[['unit'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type_id' => Yii::t('app', 'Tüüp'),
            'name' => Yii::t('app', 'Nimetus'),
            'model' => Yii::t('app', 'Mudel'),
            'value' => Yii::t('app', 'Väärtus'),
			'unit' => Yii::t('app', 'Ühik'),
            'price' => Yii::t('app', 'Hind'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(FieldType::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductFields()
    {
        return $this->hasMany(ProductField::className(), ['field_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return FieldQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FieldQuery(get_called_class());
    }
}
