<?php

namespace fredyns\region\controllers;

use fredyns\region\models\District;
use fredyns\region\models\search\DistrictSearch;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * This is the class for controller "DistrictController".
 */
class DistrictController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'depdrop-options' => [
                'class' => \fredyns\region\actions\DepdropOptions::class,
                'modelClass' => \fredyns\region\models\District::class,
                'parentAttributes' => [
                    'province_id',
                    'city_id',
                ],
            ],
        ];
    }

    /**
     * Lists all District models.
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DistrictSearch;
        $dataProvider = $searchModel->search($_GET);

        Url::remember();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single District model.
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
     * Creates a new District model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new District;

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
     * Updates an existing District model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return string|\yii\web\Response
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
     * Deletes an existing District model.
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
     * Finds the District model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return District the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = District::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
