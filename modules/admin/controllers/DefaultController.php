<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\LoginForm;
use app\modules\admin\models\Contact;
use yii\web\Controller;
use yii\web\Response;

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

        if ($model->load(\Yii::$app->request->post())) {
            $model->reCaptcha = Yii::$app->getRequest()->post('g-recaptcha-response');

            if ($model->login()) {

                return $this->redirect('/admin/default');
            }
        }

        $model->password = '';

        return $this->render('login', ['model' => $model]);
    }

    public function actionLogout() {
        \Yii::$app->getUser()->logout();

        return $this->redirect('/admin/default/login');
    }

    public function actionGetNewFeedback()
    {
        // make session read-only
//        session_start();
        session_write_close();

        // disable default disconnect checks
        ignore_user_abort(true);

        // set headers for stream
        header("Content-Type: text/event-stream");
        header("Cache-Control: no-cache");
//        header("Access-Control-Allow-Origin: *");

        // Is this a new stream or an existing one?
        $lastEventId = floatval(isset($_SERVER["HTTP_LAST_EVENT_ID"]) ?
            $_SERVER["HTTP_LAST_EVENT_ID"] : 0);
        if ($lastEventId == 0) {
            $lastEventId = floatval(isset($_GET["lastEventId"]) ?
                $_GET["lastEventId"] : 0);
        }
        $latestCountNewFeedback = -1;

        echo ":" . str_repeat(" ", 2048) . "\n"; // 2 kB padding for IE
        echo "retry: 2000\n";

        // start stream
        while (true) {

            if (connection_aborted()) {
                exit();
            } else {
                // here you will want to get the latest event id you have created
                // on the server, but for now we will increment and force an update
                $latestEventId = $lastEventId + 1;


                // count new feedback
                $currentCountNewFeedback = (int) Contact::find()->where(['status' => Contact::STATUS_NEW])->count();

                if ($lastEventId < $latestEventId && $latestCountNewFeedback != $currentCountNewFeedback) {

                    echo "id: " . $latestEventId . "\n";
                    echo "data: " . $currentCountNewFeedback ." \n\n";
                    $lastEventId = $latestEventId;
                    ob_flush();
                    flush();

                } else {

                    // no new data to send
                    echo ": heartbeat\n\n";
                    ob_flush();
                    flush();

                }

                $latestCountNewFeedback = $currentCountNewFeedback;

            }

            // 10 second sleep then carry on
            sleep(10);

        }
    }
}
