<?php

namespace common\models;

use mdm\upload\FileModel;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

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
     * @param $id
     * @return bool
     */
    public static function setPreview($id)
    {
        $model = self::find()->where(['file_id' => $id])->one();
        if (!$model) {
            return false;
        }
        self::updateAll(['type' => self::TYPE_DEFAULT], ['item_id' => $model->item_id]);
        $model->type = self::TYPE_PREVIEW;
        return $model->save();
    }

    /**
     * @param Item $model
     * @param \yii\web\UploadedFile[] $files
     */
    public static function saveFiles($model, $files)
    {
        foreach ($files as $file) {
            if($fileModel = FileModel::saveAs($file, '@common/upload')) {
                $itemFile = new static();
                $itemFile->file_id = $fileModel->id;
                $itemFile->item_id = $model->id;
                $itemFile->save();
            }
        }
    }

    /**
     * @param \common\models\Item $model
     * @return array
     */
    public static function getInitialPreview($model)
    {
        $data = [];
        foreach ($model->getItemFiles()->all() as $file) {
            $data[] = Html::img($file->getFileUrl(), ['class' => 'file-preview-image']);
        }
        return $data;
    }

    /**
     * @return string
     */
    public function getFileUrl()
    {
        return Url::to(['/file', 'id' => $this->file_id]);
    }

    /**
     * @param \common\models\Item $model
     * @return array
     */
    public static function getInitialPreviewConfig($model)
    {
        $data = [];
        foreach ($model->getItemFiles()->all() as $file) {
            $data[] = [
                'key' => $file->file_id,
                'url' => Url::to(['/file/delete', 'id' => $file->file_id]),
                'frameClass' => $file->type == ItemFile::TYPE_PREVIEW ? 'b-item-image-preview' : null,
            ];
        }
        return $data;
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
