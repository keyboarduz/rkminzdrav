<?php

namespace app\controllers;

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
        $news = News::find()
            ->where(['status' => News::STATUS_ACTIVE])
            ->orderBy('created_at DESC')
            ->limit(5)
            ->all();

        return $this->render('index', [
            'news' => $news,
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
}
