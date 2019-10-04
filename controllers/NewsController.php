<?php
/**
 * Created by PhpStorm.
 * User: Javlonbek
 * Date: 22.08.2019
 * Time: 14:47
 */

namespace app\controllers;

use Yii;
use app\modules\admin\models\News;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class NewsController extends Controller
{
    public $layout = 'minzd';
    public $defaultAction = 'all';

    public function actionAll() {
        $query = News::find()
            ->where(['status' => News::STATUS_ACTIVE])
            ->orderBy('created_at DESC');

        $countQuery = clone $query;

        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'defaultPageSize' => 5,
        ]);

        $news = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('all', [
            'news' => $news,
            'pages' => $pages,
        ]);
    }

    public function actionView() {
        $id = Yii::$app->request->get('id');

        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    protected function findModel($id) {
        $model = News::findOne(['id' => $id, 'status' => News::STATUS_ACTIVE]);

        if ( $model === null ) {
            throw new NotFoundHttpException('Bunday yangilik topilmadi');
        }

        return $model;
    }

}