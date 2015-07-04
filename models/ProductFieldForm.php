<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ProductFieldForm extends Model
{
    public $id;
	public $product_id;
	public $field_id;
	public $fields;

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
}
