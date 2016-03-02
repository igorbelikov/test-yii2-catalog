<?php

namespace frontend\controllers;

use common\models\Item;
use common\models\Tree;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class ItemController extends \yii\web\Controller
{
    public function actionView($id)
    {
        $model = Item::findOne($id);

        if (!$model) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested item does not exist.'));
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * @param int $id
     * @return string
     * @throws NotFoundHttpException
     */
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

    /**
     * @return string
     */
    public function actionIndex()
    {
    	$dataProvider = new ActiveDataProvider([
    		'query' => Tree::find()->roots(),
    	]);

        return $this->render('index', [
    		'dataProvider' => $dataProvider,
    	]);
    }

    /**
     * @param $id
     * @return null|static
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Tree::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
}
