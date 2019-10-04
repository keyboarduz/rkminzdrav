<?php

namespace app\controllers;

use app\modules\admin\models\Organization;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

class OrganizationController extends \yii\web\Controller
{
    public $layout = 'minzd';
    public $defaultAction = 'republic-organizations';

    public function actionDistrictMedicalAssociations()
    {
        $query = Organization::find()
            ->where(['category' => Organization::ORGANIZATION_DISTRICT_MEDICAL_ASSOCIATION]);
        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'defaultPageSize' => 10,
        ]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('district-medical-associations', [
            'models' => $models,
            'pages' => $pages,
        ]);
    }

    public function actionRepublicOrganizations()
    {
        $query = Organization::find()->where(['category' => Organization::ORGANIZATION_REPUBLIC]);
        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'defaultPageSize' => 10,
        ]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();


        return $this->render('republic-organizations', [
            'models' => $models,
            'pages' => $pages,
        ]);
    }

}
