<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ItemFile]].
 *
 * @see ItemFile
 */
class ItemFileQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ItemFile[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ItemFile|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
