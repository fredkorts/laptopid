<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Field]].
 *
 * @see Field
 */
class FieldQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Field[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Field|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}