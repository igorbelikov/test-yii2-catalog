<?php

namespace common\models;

use mdm\upload\FileModel;
use Yii;

/**
 * This is the model class for table "{{%item}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $category_id
 *
 * @property Tree $category
 * @property ItemFile[] $itemFiles
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * @var null
     */
    public $images;

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $files = \yii\web\UploadedFile::getInstances($this, 'images');
            if ($files) {
                ItemFile::saveFiles($this, $files);
            }
            return true;
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['category_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tree::className(), 'targetAttribute' => ['category_id' => 'id']],
            ['images', 'image', 'extensions' => 'png, jpg, gif', 'maxFiles' => 5],
            ['images', function ($attribute, $params) {
                $files = \yii\web\UploadedFile::getInstances($this, 'images');
                if ((count($files) + $this->getItemFiles()->count()) > 5) {
                    $this->addError($attribute, 'Images must be less 5.');
                }
            }, 'whenClient' => ""]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'content' => Yii::t('app', 'Content'),
            'category_id' => Yii::t('app', 'Category'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Tree::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemFiles()
    {
        return $this->hasMany(ItemFile::className(), ['item_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ItemQuery(get_called_class());
    }
}
