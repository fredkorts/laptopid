<?php

namespace app\models;

use yii\db\ActiveRecord;

class ProductField extends ActiveRecord
{
    public $id;
	public $product_id;
	public $field_id;
	public $field;
	/**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
			['id', 'primary'],
			['product_id', 'number'],
			['field_id', 'number'],
        ];
    }
	/*public function fields()
	{
		return ['product_id', 'field_id'];
	}*/
	
	/*public function getfield()
	{
		$fields = Field::find()->where(['id' => $this->field_id])->all();
		return $fields;
	}*/
	
    /*public function getField()
    {
        return $this->hasMany(Field::className(), ['field_id' => 'id']);
    }*/
	
	/*public function relations() { yii1 maybe
		return array(
			'product_field' => array(self::HAS_MANY, 'ProductField', 'product_id')
		);
	}*/
	
	
	/*public function getProduct() {
		return $this->hasMany(ProductField::className(), ['id' => 'product_id'])
		  ->viaTable('product_field', ['product_id' => 'id']);
	}*/
	/*public function getProduct() {
		return $this->hasOne(Product::className(), ['id' => 'product_id']);
	}*/
	/*public function getProduct() {
		return $this->hasMany(Product::className(), ['id' => 'product_id'])
		  ->viaTable('product_field', ['id' => 'product_id']);
	}
	
    public function getField()
    {
        return $this->hasOne(Field::className(), ['id' => 'field_id']);
    }*/
    /*public function getField()
    {
        return $this->hasOne(Field::className(), ['ID' => 'field_id']);
    }*/
	
	/*public function getSafeName()
	{
		//UTF-8 urls are supported by most of browsers by now
		//$url = str_replace(array(' ','õ','ä','ö','ü'), array('-','o','a','o','u'), $this->getName());
		$url = str_replace(' ', '-', $this->mfr.$this->model);
		$url = preg_replace('/[^a-z0-9\-]/', '', strtolower($url));
			
		return preg_replace('/-+/', '-', $url);
	}*/
}