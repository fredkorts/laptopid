<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use app\models\Product;

/**
 * ContactForm is the model behind the contact form.
 */
class ProductCreateForm extends Model
{
	public $id;
    public $mfr;
	public $model;
	public $price;
	public $cut_price;
	public $stock;
	public $active;
	public $description;
	public $highlighted;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
			
			//[['mfr', 'model', 'price', 'description'], 'required'],
        	['mfr', 'string'],
			['model', 'string'],
			['price', 'number'],
			['cut_price', 'number'],
			['stock', 'number'],
			['active', 'boolean'],
			['description', 'string'],
			['highlighted', 'boolean'],
        ];
    }
	
	public function attributeLabels()
	{
		return [
			'mfr' => 'Tootja',
			'model' => 'Mudel',
			'price' => 'Hind',
			'cut_price' => 'Soodushind',
			'stock' => 'Laoseis',
			'description' => 'Toote kirjeldus',
			'active' => 'Aktiivne?',
			'highlighted' => 'Tõsta esile?',
		];
	}
	
}
