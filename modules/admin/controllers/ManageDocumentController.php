<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\form\UploadForm;
use Yii;
use app\modules\admin\models\Document;
use app\modules\admin\models\search\DocumentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ManageDocumentController implements the CRUD actions for Document model.
 */
class ManageDocumentController extends Controller
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
     * Lists all Document models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocumentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Document model.
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
     * Creates a new Document model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Document();
        $fileModel = new UploadForm(['scenario' => UploadForm::SCENARIO_UPLOAD_DOCUMENT]);
        $fileModel->maxFileSize = 1024*1000*4;
        $fileModel->filePath = Yii::getAlias('@webroot/uploads/documents');

        if ( Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) ) {
            $fileModel->file = UploadedFile::getInstance($fileModel, 'file');

            if ($fileModel->file !== null) {
                if (
                    $fileModel->validate()
                    && ($model->file = $fileModel->uploadFile('file'))
                    && $model->save()
                ) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            elseif ($model->save()) {

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'fileModel' => $fileModel,
        ]);
    }

    /**
     * Updates an existing Document model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $fileModel = new UploadForm(['scenario' => UploadForm::SCENARIO_UPLOAD_DOCUMENT]);
        $fileModel->maxFileSize = 1024*1000*4;
        $fileModel->filePath = Yii::getAlias('@webroot/uploads/documents');

        if ( Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) ) {
            $fileModel->file = UploadedFile::getInstance($fileModel, 'file');

            if ($fileModel->file !== null) {
                if (
                    $fileModel->validate()
                    && ($model->file = $fileModel->uploadFile('file'))
                    && $model->save()
                ) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            elseif ($model->save()) {

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'fileModel' => $fileModel,
        ]);
    }

    /**
     * Deletes an existing Document model.
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
     * Finds the Document model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Document the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Document::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
