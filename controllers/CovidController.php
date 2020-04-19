<?php


namespace app\controllers;

use Yii;
use app\modules\admin\models\News;
use yii\web\Controller;
use app\models\repository\CovidRepository;

class CovidController extends Controller
{
    public $layout = 'materialize';

    public function actionNews() {
        $cache = Yii::$app->getCache();

        $covidData = $cache->get('covidData');
        if ($covidData === false || !$covidData) {
            $covidData = CovidRepository::getCovidData();
            $cache->set('covidData', $covidData, 60*10);
        }

        $news = News::find()
            ->where(['category_id' => 6])
            ->orderBy('created_at DESC')
            ->all();

        return $this->render('news', [
            'news' => $news,
            'covidData' => $covidData,
        ]);
    }
}