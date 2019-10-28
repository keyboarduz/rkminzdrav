<?php

namespace app\controllers;

use app\modules\admin\models\Document;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;

class DocumentController extends Controller
{
    public $layout = 'minzd';
    public $defaultAction = 'all';

    public function actionAll() {
        $query = Document::find();
        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'defaultPageSize' => 10
        ]);
        $documents = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('all', [
            'documents' => $documents,
            'pages' => $pages,
        ]);
    }

    public function actionType($id) {

        $countTypes = Document::getCountTypes();
//        var_dump($countTypes); die;

        $query = Document::find()->where(['type' => $id]);
        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'defaultPageSize' => 10
        ]);
        $documents = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('all', [
            'documents' => $documents,
            'pages' => $pages,
        ]);
    }
}