<?php
/* @var $this yii\web\View */
/* @var $countContact string */

use yii\helpers\Url;

?>
<div class="admin-default-index">

    <div class="row">
        <div class="col-sm-4">
            <a href="<?=Url::to(['contact/index'])?>" class="info-box">
                <!-- Apply any bg-* class to to the icon to color it -->
                <span class="info-box-icon bg-aqua"><i class="fa fa-envelope"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Murojatlar</span>
                    <span class="info-box-number"><?=$countContact?></span>
                </div>
                <!-- /.info-box-content -->
            </a>
        </div>
    </div>
</div>
