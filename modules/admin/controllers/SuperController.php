<?php


namespace app\modules\admin\controllers;


use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class SuperController extends Controller
{

//    public function behaviors()
//    {
//        return [
//            'access' => [
//                'class' => AccessControl::class,
//                'rules' => [
//                    [
//                        'allow' => true,
//                        'roles' => ['superAdmin']
//                    ]
//                ]
//            ]
//        ];
//    }

    public function actionOk() {
        return 'Welcome to super!';
    }

    public function actionRbacInit() {
        $this->rbacInit();
    }

    public function actionMigrateUp() {
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

    protected function rbacInit() {
        $auth = Yii::$app->getAuthManager();

        $manageNews = $auth->createPermission('manageNews');
        $manageNews->description = 'Yangiliklarni boshqarish';
        if ($auth->getPermission('manageNews') === null) {
            $auth->add($manageNews);
        }

        $createNews = $auth->createPermission('createNews');
        $createNews->description = 'Yangilik yaratish';
        if ($auth->getPermission($createNews->name) === null) {
            $auth->add($createNews);
        }

        $updateNews = $auth->createPermission('updateNews');
        $updateNews->description = 'Yangilikni o\'zgartirish';
        if ($auth->getPermission($updateNews->name) === null) {
            $auth->add($updateNews);
        }

        $viewNews = $auth->createPermission('viewNews');
        $viewNews->description = 'Yangilikni ko\'rish';
        if ($auth->getPermission('viewNews') === null) {
            $auth->add($viewNews);
        }

        $deleteNews = $auth->createPermission('deleteNews');
        $deleteNews->description = "Yangilikni o'chirish";
        if ($auth->getPermission('deleteNews') === null) {
            $auth->add($deleteNews);
        }

        $uploadImage = $auth->createPermission('uploadImage');
        $uploadImage->description = "Rasm yuklash";
        if ($auth->getPermission('uploadImage') === null) {
            $auth->add($uploadImage);
        }

        $admin = $auth->createRole('admin');
        if ($auth->getRole($admin->name) === null) {
            $auth->add($admin);
        }

        if ($admin = $auth->getRole('admin')) {
            if (!$auth->hasChild($admin, $manageNews = $auth->getPermission('manageNews'))) {
                $auth->addChild($admin, $manageNews);
                echo '"admin" ga yangiliklarni boshqarish imkoniyati berildi' . PHP_EOL;
            }
        }

        if ($admin = $auth->getRole('admin')) {
            if (!$auth->hasChild($admin, $createNews = $auth->getPermission('createNews'))) {
                $auth->addChild($admin, $createNews);
            }
        }

        if ($admin = $auth->getRole('admin')) {
            if (!$auth->hasChild($admin, $updateNews = $auth->getPermission('updateNews'))) {
                $auth->addChild($admin, $updateNews);
                echo '"admin" ga yangilikni yangilash imkoniyati berild' . PHP_EOL;
            }
        }

        if ($admin = $auth->getRole('admin')) {
            if (!$auth->hasChild($admin, $viewNews = $auth->getPermission('viewNews'))) {
                $auth->addChild($admin, $viewNews);
                echo '"admin" ga yangilikni ko\'rish imkoniyati berildi' . PHP_EOL;
            }
        }

        if ($admin = $auth->getRole('admin')) {
            if (!$auth->hasChild($admin, $deleteNews = $auth->getPermission('deleteNews'))) {
                $auth->addChild($admin, $deleteNews);
                echo '"admin" ga yangilikni o\'chirish imkoniyati berildi' . PHP_EOL;
            }
        }

        if ($admin = $auth->getRole('admin')) {
            if (!$auth->hasChild($admin, $uploadImage = $auth->getPermission('uploadImage'))) {
                $auth->addChild($admin, $uploadImage);
                echo '"admin" ga rasm yuklash imkoniyati berildi'. PHP_EOL;
            }
        }

        $superAdmin = $auth->createRole('superAdmin');
        if ($auth->getRole($superAdmin->name) === null) {
            if ($auth->add($superAdmin) && $auth->canAddChild($superAdmin, $admin)) {
                $auth->addChild($superAdmin, $admin);
            }
        }

        try {
            $auth->assign($admin, 1);
            $auth->assign($superAdmin, YII_ENV_PROD ? 3 : 2);
        } catch (\Exception $e) {
            echo 'Role has already been assigned to the user'. PHP_EOL;
        }
    }
}