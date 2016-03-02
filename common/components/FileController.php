<?php

namespace common\components;

use common\models\ItemFile;
use Yii;

/**
 * Class FileController
 * @package common\components
 * @author Igor Belikov <work.belka@gmail.com>
 */
class FileController extends \mdm\upload\FileController
{
    /**
     * @var bool
     */
    public $enableCsrfValidation = false;

    /**
     * @return array
     */
    public function actionSetItemImagePreview()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return ['success' => ItemFile::setPreview(Yii::$app->request->post('id'))];
    }

    /**
     * @param $id
     * @return array
     * @throws \Exception
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionDelete($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = $this->findModel($id);

        if ($model->delete()) {
            return [$model->id];
        }

        return [];
    }
}