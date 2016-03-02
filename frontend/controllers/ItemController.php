<?php

namespace frontend\controllers;

use common\models\Tree;
use yii\data\ActiveDataProvider;

class ItemController extends \yii\web\Controller
{
    public function actionCategory($id)
    {
        $model = $this->findModel($id);

        $dataProvider = new ActiveDataProvider([
            'query' => $model->children(1),
        ]);

        $itemDataProvider = new ActiveDataProvider([
            'query' => $model->getItems(),
        ]);

        return $this->render('category', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'itemDataProvider' => $itemDataProvider,
        ]);
    }

    public function actionIndex()
    {
    	$dataProvider = new ActiveDataProvider([
    		'query' => Tree::find()->roots(),
    	]);

        return $this->render('index', [
    		'dataProvider' => $dataProvider,
    	]);
    }

    protected function findModel($id)
    {
        if (($model = Tree::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
}
