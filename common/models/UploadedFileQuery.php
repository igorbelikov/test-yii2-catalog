<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[UploadedFile]].
 *
 * @see UploadedFile
 */
class UploadedFileQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return UploadedFile[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UploadedFile|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
