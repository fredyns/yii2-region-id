<?php

namespace fredyns\region\controllers;

use fredyns\region\models\City;
use fredyns\region\models\search\CitySearch;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * This is the class for controller "CityController".
 */
class CityController extends Controller
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'depdrop-options' => [
                'class' => \fredyns\region\actions\DepdropOptions::class,
                'modelClass' => \fredyns\region\models\City::class,
                'parentAttributes' => [
                    'province_id',
                ],
            ],
        ];
    }

    /**
     * Lists all City models.
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CitySearch;
        $dataProvider = $searchModel->search($_GET);

        Url::remember();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single City model.
     * @param integer $id
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        Url::remember();

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new City model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return Response|string
     */
    public function actionCreate()
    {
        $model = new City;

        try {
            if ($model->load($_POST) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } elseif (!Yii::$app->request->isPost) {
                $model->load($_GET);
            }
        } catch (\Exception $e) {
            $model->addError('_exception', $e->getMessage());
        }

        return $this->render('create', ['model' => $model]);
    }

    /**
     * Updates an existing City model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load($_POST) && $model->save()) {
            return $this->redirect(Url::previous());
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing City model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws \Throwable
     */
    public function actionDelete($id)
    {
        try {
            $this->findModel($id)->delete();
        } catch (\Exception $e) {
            Yii::$app->getSession()->addFlash('error', $e->getMessage());
        } finally {
            return $this->redirect(Url::previous());
        }
    }

    /**
     * Finds the City model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return City the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = City::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}