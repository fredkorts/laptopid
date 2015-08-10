<?php

namespace app\models;

use Yii;
use yii2mod\cart\models\CartItemInterface;
use zxbodya\yii2\galleryManager\GalleryBehavior;
use comparison\comparison\models\ComparisonItemInterface;


/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $mfr
 * @property string $model
 * @property string $price
 * @property string $cut_price
 * @property integer $stock
 * @property integer $active
 * @property string $description
 * @property integer $highlighted
 *
 * @property ProductField[] $productFields
 */
class Product extends \yii\db\ActiveRecord implements CartItemInterface, ComparisonItemInterface
{
    /**
     * @inheritdoc
     */
	public $product_field;
	public $field;
	public $field_type;
	 
    public static function tableName()
    {
        return 'product';
    }
	
	public function behaviors()
	{
		return [
			 'galleryBehavior' => [
				 'class' => GalleryBehavior::className(),
				 'type' => 'product',
				 'extension' => 'jpg',
				 'directory' => Yii::getAlias('@webroot') . '/images/product',
				 'url' => Yii::getAlias('@web') . '/images/product',
				 'versions' => [
					 'small' => function ($img) {
						 /** @var \Imagine\Image\ImageInterface $img */
						 return $img
							 ->copy()
							 ->thumbnail(new \Imagine\Image\Box(200, 200));
					 },
					 'medium' => function ($img) {
						 /** @var Imagine\Image\ImageInterface $img */
						 $dstSize = $img->getSize();
						 $maxWidth = 800;
						 if ($dstSize->getWidth() > $maxWidth) {
							 $dstSize = $dstSize->widen($maxWidth);
						 }
						 return $img
							 ->copy()
							 ->resize($dstSize);
					 },
				 ]
			 ]
		];
	}
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mfr','model','description','price','stock'], 'required'],
            [['price', 'cut_price'], 'number'],
            [['stock', 'active', 'highlighted'], 'integer'],
            [['description'], 'string'],
            [['mfr', 'model'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'mfr' => Yii::t('app', 'Tootja'),
            'model' => Yii::t('app', 'Mudel'),
            'price' => Yii::t('app', 'Hind'),
            'cut_price' => Yii::t('app', 'Soodushind'),
            'stock' => Yii::t('app', 'Laos'),
            'active' => Yii::t('app', 'Aktiivne'),
            'description' => Yii::t('app', 'Kirjeldus'),
            'highlighted' => Yii::t('app', 'Esile tõstetud'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductField()
    {
		//var_dump($this->hasMany(ProductField::className(), ['product_id' => 'id']));die;
        return $this->hasMany(ProductField::className(), ['product_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }
	
	public function getLabel()
	{
		return $this->model;
	}
	
	public function getUniqueId()
	{
		return $this->id;
	}
}
