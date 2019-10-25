<?php

namespace app\controllers;

use app\modules\admin\models\GeneralInformation;
use app\modules\admin\models\Leadership;

class MinistryController extends \yii\web\Controller
{
    public $layout = 'minzd';

    public function actionGeneralInformation()
    {
        $generalInformation = GeneralInformation::findOne(1);

        return $this->render('general-information', [
            'generalInformation' => $generalInformation,
        ]);
    }

    public function actionLeadership() {
        $leaderships = Leadership::find()->all();

        return $this->render('leadership', [
           'leaderships' => $leaderships
        ]);
    }

}
