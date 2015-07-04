<?php

namespace app\models;

use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    public $id;
    public $mfr;
    public $model;
    public $price;
    public $cut_price;
    public $stock;
    public $active;
    public $description;
    public $product_field;
	public $field;
	public $field_type;
	/**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
        	['id', 'primary'],
        	['mfr', 'required'],
            ['model', 'required'],
			// must be less or equal than 120 characters
			['mfr', 'string'], // mfr = manufacturer
			//[['mfr'], 'string', 'max' => 40], // mfr = manufacturer
			['model', 'string', 'max' => 40],
			['price', 'number'],
			['cut_price', 'number'],
			['stock', 'number'],
			['active', 'boolean'],
			//['content', 'default', 'value' => '']
        ];
    }
	
	public function getSafeName()
	{
		//UTF-8 urls are supported by most of browsers by now
		//$url = str_replace(array(' ','õ','ä','ö','ü'), array('-','o','a','o','u'), $this->getName());
		$url = str_replace(' ', '-', $this->mfr.$this->model);
		$url = preg_replace('/[^a-z0-9\-]/', '', strtolower($url));
			
		return preg_replace('/-+/', '-', $url);
	}
	
	/*public function getProduct_field() {
		return $this->hasMany(ProductField::className(), ['id' => 'product_id'])
		  ->viaTable('product_field', ['product_id' => 'id']);
	}*/
	/*public function getProfield() {
		return $this->hasMany(ProductField::className(), ['id' => 'product_id'])
		  ->viaTable('product_field', ['product_id' => 'id']);
	}*/
	/*public function getProfield() {
		return $this->hasMany(ProductField::className(), ['product_id' => 'id']);
	}*/
    public function getProduct_field()
    {
        return $this->hasMany(ProductField::className(), ['product_id' => 'id']);
    }
	
	
}