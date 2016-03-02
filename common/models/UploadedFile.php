<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%uploaded_file}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $filename
 * @property integer $size
 * @property string $type
 *
 * @property ItemFile[] $itemFiles
 */
class UploadedFile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%uploaded_file}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['size'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['filename'], 'string', 'max' => 256],
            [['type'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'filename' => Yii::t('app', 'Filename'),
            'size' => Yii::t('app', 'Size'),
            'type' => Yii::t('app', 'Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemFiles()
    {
        return $this->hasMany(ItemFile::className(), ['file_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return UploadedFileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UploadedFileQuery(get_called_class());
    }
}
