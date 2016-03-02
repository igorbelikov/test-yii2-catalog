<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Tree]].
 *
 * @see Tree
 */
class TreeQuery extends \gilek\gtreetable\models\TreeQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Tree[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Tree|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
