<?php

namespace backend\controllers;

use Yii;
use common\models\Tree;
use common\models\TreeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for Tree model.
 */
class CategoryController extends Controller
{
	/**
	 * @return array
	 */
	public function actions()
	{
		return [
			'nodeChildren' => [
				'class' => 'gilek\gtreetable\actions\NodeChildrenAction',
				'treeModelName' => Tree::className()
			],
			'nodeCreate' => [
				'class' => 'gilek\gtreetable\actions\NodeCreateAction',
				'treeModelName' => Tree::className()
			],
			'nodeUpdate' => [
				'class' => 'gilek\gtreetable\actions\NodeUpdateAction',
				'treeModelName' => Tree::className()
			],
			'nodeDelete' => [
				'class' => 'gilek\gtreetable\actions\NodeDeleteAction',
				'treeModelName' => Tree::className()
			],
			'nodeMove' => [
				'class' => 'gilek\gtreetable\actions\NodeMoveAction',
				'treeModelName' => Tree::className()
			],            
    	];
  	}

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionTree()
    {
    	return $this->render('tree');
    }

    /**
     * Lists all Tree models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TreeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tree model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Updates an existing Tree model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Tree model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tree model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tree the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tree::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
