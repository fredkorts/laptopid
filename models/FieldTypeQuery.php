<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[FieldType]].
 *
 * @see FieldType
 */
class FieldTypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return FieldType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return FieldType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}