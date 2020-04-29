<?php


namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\form\UploadForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;
use yii\web\ServerErrorHttpException;
use yii\web\UploadedFile;

class UploadController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['upload-image'],
                        'roles' => ['uploadImage']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'upload-image' => ['POST'],
                ],
            ],
        ];
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

        if ($uploadForm->imageFile = UploadedFile::getInstanceByName('file')) {
            if ($fileNameWithPath = $uploadForm->uploadFile()) {
                // file uploaded
                Yii::$app->getResponse()->format = Response::FORMAT_JSON;

                return [
                    'location' => Yii::getAlias('@web/uploads/images') . UploadForm::getMd5FilePath($fileNameWithPath),
                ];
            }
            if ($uploadForm->hasErrors('imageFile')) {
                Yii::debug($uploadForm->imageFile->type, 'image-type');
                Yii::debug($uploadForm->imageFile->extension, 'image-extension');
                Yii::error($uploadForm->getErrors(), 'image-save');
                throw new BadRequestHttpException('Invalid extension or file size');
            }
        }

        throw new ServerErrorHttpException();
    }
}