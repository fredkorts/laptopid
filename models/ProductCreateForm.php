<?php

namespace app\models;

use Yii;
use yii\base\Model;

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
			[['mfr', 'model','price'], 'required'],
        	['id', 'primary'],
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
}
