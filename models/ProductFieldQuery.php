<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ProductField]].
 *
 * @see ProductField
 */
class ProductFieldQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return ProductField[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProductField|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}