<?php

namespace app\models;

use Yii;
use yii\base\Model;

class FieldTypeForm extends Model
{
	public $id;
	public $name;
	/**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
        	['name', 'string', 'max' => 40],
        ];
    }
	
	public function getSafeName()
	{
		//UTF-8 urls are supported by most of browsers by now
		//$url = str_replace(array(' ','õ','ä','ö','ü'), array('-','o','a','o','u'), $this->getName());
		$url = str_replace(' ', '-', $this->name.$this->model);
		$url = preg_replace('/[^a-z0-9\-]/', '', strtolower($url));
			
		return preg_replace('/-+/', '-', $url);
	}
}