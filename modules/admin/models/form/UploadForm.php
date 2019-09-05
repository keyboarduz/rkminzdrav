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
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            ['imageFile', 'required'],
            [
                'imageFile',
                'file',
                'extensions' => ['jpg', 'png', 'gif', 'jpeg'],
                'skipOnEmpty' => false,
            ]
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

}