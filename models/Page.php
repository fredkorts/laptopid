<?php

namespace app\models;

use yii\db\ActiveRecord;

class Page extends ActiveRecord
{
	/**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // title is required
            ['title', 'required'],
			// title must be less or equal than 120 characters
			['title', 'string', 'max' => 120],
			['content', 'default', 'value' => '']
        ];
    }
	
	public function getSafeName()
	{
		//UTF-8 urls are supported by most of browsers by now
		//$url = str_replace(array(' ','õ','ä','ö','ü'), array('-','o','a','o','u'), $this->getName());
		$url = str_replace(' ', '-', $this->title);
		$url = preg_replace('/[^a-z0-9\-]/', '', strtolower($url));
			
		return preg_replace('/-+/', '-', $url);
	}
}