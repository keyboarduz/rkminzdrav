<?php
/**
 * Created by PhpStorm.
 * User: Javlonbek
 * Date: 15.08.2019
 * Time: 19:54
 */
namespace app\modules\admin\models\form;

use app\modules\admin\models\News;
use Yii;
use yii\base\Model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    const SCENARIO_UPLOAD_IMAGE = 'upload-image';
    const SCENARIO_UPLOAD_IMAGE_UPDATE = 'upload-image-update';
    const SCENARIO_UPLOAD_DOCUMENT = 'upload-document';

    /**
     * @var UploadedFile
     */
    public $imageFile;

    public $file;

    /**
     * @var string
     */
    public $filePath;

    /**
     * @var integer
     */
    public $maxFileSize = 1024000; //1024 * 1000 -> 1 megabyte


    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_UPLOAD_IMAGE] = ['imageFile', 'filePath', 'maxFileSize'];
        $scenarios[self::SCENARIO_UPLOAD_IMAGE_UPDATE] = ['imageFile', 'filePath', 'maxFileSize'];

        return $scenarios;
    }

    public function rules()
    {
        return [
            ['imageFile', 'required', 'on' => self::SCENARIO_DEFAULT],
            ['filePath', 'string'],
            ['maxFileSize', 'integer'],
            [
                'imageFile',
                'file',
//                'extensions' => ['jpg', 'png', 'gif', 'jpeg'],
                'mimeTypes' => [
                    'image/png',
                    'image/jpeg',
                    'image/gif',
                ],
                'skipOnEmpty' => true,
                'maxSize' => $this->maxFileSize, // 1 megabyte
                'on' => [self::SCENARIO_UPLOAD_IMAGE_UPDATE, self::SCENARIO_UPLOAD_IMAGE, self::SCENARIO_DEFAULT],
            ],
            [
                'file',
                'file',
//                'extensions' => ['doc', 'docx', 'pdf'],
                'mimeTypes' => [
                    'application/pdf',
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                ],
                'skipOnEmpty' => true,
                'maxSize' => $this->maxFileSize,
                'on' => [self::SCENARIO_UPLOAD_DOCUMENT]
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'imageFile' => 'Rasm',
            'file' => 'Fayl',
        ];
    }

    public function upload(Model $model, $attribute) {

        if (!$this->validate()) {
            $this->addError('imageFile', 'Image validatsiyadan o"tmadi!');
            return false;
        }

        $fileHash = md5_file($this->imageFile->tempName);
        $hashPath = substr($fileHash, 0, 2) . '/' . substr($fileHash, 2, 2);

        $imagesDir = Yii::getAlias('@webroot') . '/uploads/images/';

        $uploadDir = $imagesDir . $hashPath;

        $fileUrl = '/uploads/images/'. $hashPath . '/' . $fileHash . '.' . $this->imageFile->getExtension();

        $fileWithDir = Yii::getAlias('@webroot') . $fileUrl;

        if (!FileHelper::createDirectory($uploadDir)) {
            Yii::$app->session->setFlash('danger', 'Rasm yuklash uchun papka ochishda xatolik');

            return false;
        }

        if (!$this->imageFile->saveAs($fileWithDir)) {
            Yii::$app->session->setFlash('danger', 'Rasmni saqlashda xatolik');

            return false;
        }

        if ($model->scenario === News::SCENARIO_UPDATE && $model->$attribute !== $fileUrl) {
            $countImage = News::find()->where(['image_url' => $fileUrl])->count();

            if ($countImage == 0) {
                FileHelper::unlink(Yii::getAlias('@webroot' . $model->$attribute));
            }
        }

        $model->$attribute = $fileUrl;

        return true;
    }

    public function uploadFile($property = 'imageFile') {
        $fileName = null;

        if (!$this->validate())
        {
            return false;
        }

        $fileName = md5_file($this->$property->tempName) . '.' . $this->$property->extension;

        $pathToFile = $this->filePath
            . '/'
            . substr($fileName, 0, 2)
            . '/'
            . substr($fileName, 2, 2)
            . '/';

        if ( !FileHelper::createDirectory($pathToFile) )
        {
            return false;
        }


        if (is_file($pathToFile . $fileName))
        {
            Yii::debug('File not saved! Because file found this dir.');

            return $fileName;
        }

        if (!$this->$property->saveAs($pathToFile . $fileName)) {
            return false;
        }

        Yii::debug('File saved');

        return $fileName;
    }

    public static function getMd5FilePath (string $imageName) {
        if ($imageName === null) {
            return '';
        }
        return '/' . substr($imageName, 0 , 2) . '/' . substr($imageName, 2, 2) . '/' . $imageName;
    }

}