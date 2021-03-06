<?php
use yii\helpers\Html;
use app\modules\admin\models\Contact;

$user = Yii::$app->getUser()->getIdentity();
$newContactCount = Contact::find()->where(['status' => Contact::STATUS_NEW])->count();

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/avatar5.png" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= $user->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <!--<form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>-->
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menyu', 'options' => ['class' => 'header']],
                    ['label' => 'Foydalnuvchilar', 'icon' => 'users', 'url' => ['user/index']],
                    ['label' => 'Muassasalar', 'icon' => 'hospital-o', 'url' => ['organization/index']],
                    ['label' => 'Qayta aloqa ' . ($newContactCount != 0 ? Html::tag('span', $newContactCount, ['class' => 'badge pull-right', 'id' => 'feedbackCount']) : ''), 'encode' => false, 'icon' => 'envelope', 'url' => ['contact/index']],
                    [
                        'label' => 'Yangiliklar',
                        'icon' => 'newspaper-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Yangiliklar', 'icon' => 'newspaper-o', 'url' => ['news/index']],
                            ['label' => 'Yangilik kategoriyasi', 'icon' => 'tags', 'url' => ['category/index']],
                        ],
                    ],
                    [
                        'label' => 'Vazirlik',
                        'icon' => 'bank',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Umumiy ma\'lumot', 'url' => ['ministry/general-information'], 'icon' => 'info'],
                            ['label' => 'Rahbariyat', 'url' => ['/admin/leadership'], 'icon' => 'users'],
                        ]
                    ],
                    ['label' => 'Hujjatlar', 'icon' => 'file-text', 'url' => ['/admin/manage-document']],
                    [
                        'label' => 'Super Admin Tools',
                        'icon' => 'share',
                        'url' => '#',
                        'visible' => Yii::$app->getUser()->can('superAdmin'),
                        'items' => [
                            ['label' => 'Rbac init', 'icon' => 'file-code-o', 'url' => ['super/rbac-init']],
                            ['label' => 'Migrate up', 'icon' => 'file-code-o', 'url' => ['super/migrate-up']]
                        ]
                    ],
                    [
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'visible' => YII_DEBUG,
                        'items' => [
                            ['label' => 'Migratsiya', 'icon' => 'file-code-o', 'url' => ['super/ok'],],
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
