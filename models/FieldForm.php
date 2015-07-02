<?php

namespace app\models;

use Yii;
use yii\base\Model;

class FieldForm extends Model
{
	public $id;
	public $type_id;
	public $name;
	public $model;
	public $value;
	public $price;
	/**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
			['type_id', 'number'],
			['name', 'string', 'max' => 40],
			['model', 'string', 'max' => 40],
			['value', 'number'],
			['price', 'number'],
        ];
    }
	
	public function getSafeName()
	{
		//UTF-8 urls are supported by most of browsers by now
		//$url = str_replace(array(' ','õ','ä','ö','ü'), array('-','o','a','o','u'), $this->getName());
		$url = str_replace(' ', '-', $this->name.$this->model);
		$url = str_replace(' ', '-', $this->model.$this->model);
		$url = preg_replace('/[^a-z0-9\-]/', '', strtolower($url));
			
		return preg_replace('/-+/', '-', $url);
	}
}