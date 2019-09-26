<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\form\UploadForm;
use Yii;
use app\modules\admin\models\Organization;
use app\modules\admin\models\search\OrganizationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * OrganizationController implements the CRUD actions for Organization model.
 */
class OrganizationController extends Controller
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
     * Lists all Organization models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrganizationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Organization model.
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
     * Creates a new Organization model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Organization();
        $imageModel = new UploadForm(['scenario' => UploadForm::SCENARIO_UPLOAD_IMAGE]);
        $imageModel->filePath = Yii::getAlias('@webroot/uploads/images/');

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

        return $this->render('create', [
            'model' => $model,
            'imageModel' => $imageModel,
        ]);
    }

    /**
     * Updates an existing Organization model.
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

        return $this->render('create', [
            'model' => $model,
            'imageModel' => $imageModel,
        ]);
    }

    /**
     * Deletes an existing Organization model.
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
     * Finds the Organization model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Organization the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Organization::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
