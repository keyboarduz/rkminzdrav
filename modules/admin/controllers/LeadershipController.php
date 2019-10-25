<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\form\UploadForm;
use Yii;
use app\modules\admin\models\Leadership;
use app\modules\admin\models\search\LeadershipSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * LeadershipController implements the CRUD actions for Leadership model.
 */
class LeadershipController extends Controller
{
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

    /**
     * Lists all Leadership models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LeadershipSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Leadership model.
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
     * Creates a new Leadership model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Leadership();
        $imageModel = new UploadForm(['scenario' => UploadForm::SCENARIO_UPLOAD_IMAGE]);
        $imageModel->filePath = Yii::getAlias('@webroot/uploads/images/');

        if ( Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) ) {
            $imageModel->imageFile = UploadedFile::getInstance($imageModel, 'imageFile');

            if ($imageModel !== null) {
                if (
                    $imageModel->validate()
                    && ($model->photo = $imageModel->uploadFile())
                    && $model->save()
                )
                {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            elseif ($model->save()) {

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'imageModel' => $imageModel,
        ]);
    }

    /**
     * Updates an existing Leadership model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $imageModel = new UploadForm(['scenario' => UploadForm::SCENARIO_UPLOAD_IMAGE_UPDATE]);
        $imageModel->filePath = Yii::getAlias('@webroot/uploads/images');

        if ( Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) ) {
            $imageModel->imageFile = UploadedFile::getInstance($imageModel, 'imageFile');

            if ($imageModel->imageFile !== null)
            {
                if (
                    $imageModel->validate()
                    && ($model->photo = $imageModel->uploadFile())
                    && $model->save()
                )
                {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            elseif ( $model->save() )
            {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'imageModel' => $imageModel,
        ]);
    }

    /**
     * Deletes an existing Leadership model.
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
     * Finds the Leadership model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Leadership the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Leadership::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
