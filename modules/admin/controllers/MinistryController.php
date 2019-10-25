<?php
/**
 * Created by PhpStorm.
 * User: sparrow
 * Date: 10/23/19
 * Time: 4:22 PM
 */

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\GeneralInformation;
use yii\web\Controller;

class MinistryController extends Controller
{
    public function actionGeneralInformation() {

        $model = GeneralInformation::findOne(['id' => 1]);

        if ($model === null) {
            $model = new GeneralInformation();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Ma'lumot saqlandi");

            return $this->refresh();
        }

        return $this->render('general-information', [
            'model' => $model,
        ]);
    }
}