<?php

namespace app\modules\admin\controllers;

use app\models\LoginForm;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin() {
        $this->layout = 'main-login';

        $model = new LoginForm();

        if ($model->load(\Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('/admin/default');
        }

        return $this->render('login', ['model' => $model]);
    }

    public function actionLogout() {
        \Yii::$app->getUser()->logout();

        return $this->redirect('/admin/default/login');
    }
}
