<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "field_type".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Field[] $fields
 */
class FieldType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'field_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFields()
    {
        return $this->hasMany(Field::className(), ['type_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return FieldTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FieldTypeQuery(get_called_class());
    }
}
