<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%item_file}}".
 *
 * @property integer $id
 * @property integer $item_id
 * @property integer $file_id
 * @property integer $type
 *
 * @property UploadedFile $file
 * @property Item $item
 */
class ItemFile extends \yii\db\ActiveRecord
{
    const TYPE_DEFAULT = 1;
    const TYPE_PREVIEW = 2;

    /**
     * @param common\models\Item $model
     * @return array
     */
    public static function getInitialPreview($model)
    {
        $data = [];
        foreach ($model->getItemFiles()->all() as $file) {
            $data[] = Html::img(['/file', 'id' => $file->file_id], ['class' => 'file-preview-image']);;
        }
        return $data;
    }

    /**
     * @param common\models\Item $model
     * @return array
     */
    public static function getInitialPreviewConfig($model)
    {
        $data = [];
        foreach ($model->getItemFiles()->all() as $file) {
            $data[] = [
                'key' => $file->id,
                'url' => '#',
            ];
        }
        return $data;
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => 'mdm\upload\UploadBehavior',
                'attribute' => 'file', // required, use to receive input file
                'savedAttribute' => 'file_id', // optional, use to link model with saved file.
                'uploadPath' => '@common/upload', // saved directory. default to '@runtime/upload'
                'autoSave' => true, // when true then uploaded file will be save before ActiveRecord::save()
                'autoDelete' => true, // when true then uploaded file will deleted before ActiveRecord::delete()
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%item_file}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'file_id'], 'required'],
            [['item_id', 'file_id', 'type'], 'integer'],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => UploadedFile::className(), 'targetAttribute' => ['file_id' => 'id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'file_id' => Yii::t('app', 'File ID'),
            'type' => Yii::t('app', 'Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(UploadedFile::className(), ['id' => 'file_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }

    /**
     * @inheritdoc
     * @return ItemFileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ItemFileQuery(get_called_class());
    }
}
