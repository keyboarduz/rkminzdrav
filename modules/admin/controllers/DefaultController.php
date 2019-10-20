<?php

namespace app\modules\admin\controllers;

use app\models\LoginForm;
use app\modules\admin\models\Contact;
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
        $countContact = Contact::find()->where(['status' => Contact::STATUS_NEW])->count();

//        var_dump($countContact); die;

        return $this->render('index', [
            'countContact' => $countContact
        ]);
    }

    public function actionLogin() {
        $this->layout = 'main-login';

        $model = new LoginForm();

        if ($model->load(\Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('/admin/default');
        }

        $model->password = '';

        return $this->render('login', ['model' => $model]);
    }

    public function actionLogout() {
        \Yii::$app->getUser()->logout();

        return $this->redirect('/admin/default/login');
    }
}
