<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tree}}".
 *
 * @property integer $id
 * @property string $root
 * @property string $lft
 * @property string $rgt
 * @property integer $level
 * @property string $type
 * @property string $name
 *
 * @property Item[] $items
 */
class Tree extends \gilek\gtreetable\models\TreeModel 
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tree}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'root' => Yii::t('app', 'Root'),
            'lft' => Yii::t('app', 'Lft'),
            'rgt' => Yii::t('app', 'Rgt'),
            'level' => Yii::t('app', 'Level'),
            'type' => Yii::t('app', 'Type'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['category_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return TreeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TreeQuery(get_called_class());
    }
}
