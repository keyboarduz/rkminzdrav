<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\form\UploadForm;
use Yii;
use app\modules\admin\models\News;
use app\modules\admin\models\search\NewsSearch;
use yii\helpers\FileHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\ServerErrorHttpException;
use yii\web\UploadedFile;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
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
                    'upload-image' => ['POST'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if ($action->id === 'upload-image') {
            $this->enableCsrfValidation = false;
        }

        if (!parent::beforeAction($action)) {
            return false;
        }

        return true;
    }

    /**
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News(['scenario' => News::SCENARIO_CREATE]);
        $uploadModel = new UploadForm();


        if ( Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            $uploadModel->imageFile = UploadedFile::getInstance($uploadModel, 'imageFile');

            if ( $uploadModel->upload( $model, 'image_url' ) && $model->save() ) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'uploadModel' => $uploadModel,
        ]);
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = News::SCENARIO_UPDATE;

        $uploadModel = new UploadForm();

        $uploadFile = (string) Yii::$app->request->post('upload_file');

        if ( Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) ) {

            $uploadModel->imageFile = UploadedFile::getInstance($uploadModel, 'imageFile');

            if ( $uploadFile === 'yes' && $uploadModel->upload( $model, 'image_url' ) && $model->save() ) {

                return $this->redirect(['view', 'id' => $model->id]);
            }
            elseif ($uploadFile === 'no' && $model->save()) {

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'uploadModel' => $uploadModel,
        ]);
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->deleteNewsWithImage();

        return $this->redirect(['index']);
    }

    /**
     * Matn redaktori rasmlarini yuklash uchun.
     * Agar rasm muvaffaqiyatli yuklansa, json da rasmga ko'rsatilgan link qaytaradi
     *
     * @return array
     * @throws ServerErrorHttpException
     * @throws BadRequestHttpException
     */
    public function actionUploadImage()
    {
        $uploadForm = new UploadForm(['scenario' => UploadForm::SCENARIO_UPLOAD_IMAGE]);
        $uploadForm->filePath = Yii::getAlias('@webroot/uploads/images');
        $uploadForm->maxFileSize = 1024 * 2 * 1000;

        // file uploaded
        if ($uploadForm->imageFile = UploadedFile::getInstanceByName('file')) {
            if ($fileNameWithPath = $uploadForm->uploadFile()) {
                Yii::$app->getResponse()->format = Response::FORMAT_JSON;

                return [
                    'location' => Yii::getAlias('@web/uploads/images') . UploadForm::getMd5FilePath($fileNameWithPath),
                ];
            }
            if ($uploadForm->hasErrors('imageFile')) {
                Yii::error($uploadForm->getErrors(), 'image-save');
                throw new BadRequestHttpException('Invalid extension or file size');
            }
        }

        throw new ServerErrorHttpException();
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
