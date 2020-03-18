<?php


namespace app\controllers;


use app\modules\admin\models\News;
use yii\web\Controller;

class CovidController extends Controller
{
    public $layout = 'materialize';

    public function actionNews() {
        $news = News::find()->where(['category_id' => 2])->all();

        return $this->render('news', [
            'news' => $news,
        ]);
    }
}