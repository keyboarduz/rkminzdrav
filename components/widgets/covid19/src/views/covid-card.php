<?php
/** @var \app\components\widgets\covid19\src\Covid19 $_self */


?>
<div class="card hoverable">
    <?php if ($_self->cardImage): ?>
        <div class="card-image">
            <img src="/images/covid.jpeg">
        </div>
    <?php endif; ?>
    <div class="card-content">
        <span class="card-title">
            Коронавирус Ўзбекистонда
        </span>
        <div class="card-text">
            <div class="row valign-wrapper">
                <div class="col s2">
                    <img src="<?= $_self->assetInstance->baseUrl . '/images/virus_covid_corona_breath_temperature.svg' ?>" alt="" class="responsive-img"> <!-- notice the "circle" class -->
                </div>
                <div class="col s10">
                    <span class="red-text">
                        <span class="covid-t"><?= Yii::t('app/covid', 'Confirmed') ?></span><br>
                        <span class="covid-n"><?=$_self->covidData['confirmed']?></span>
                    </span>
                </div>
            </div>
            <div class="divider"></div>
            <div class="row valign-wrapper">
                <div class="col s2">
                    <img src="<?= $_self->assetInstance->baseUrl . '/images/people_virus_covid_scan_temperature.svg' ?>" alt="" class="responsive-img"> <!-- notice the "circle" class -->
                </div>
                <div class="col s10">
                    <span class="green-text">
                        <span class="covid-t"><?= Yii::t('app/covid', 'Recovered') ?></span><br>
                        <span class="covid-n"><?=$_self->covidData['recovered']?></span>
                    </span>
                </div>
            </div>
            <div class="divider"></div>
            <div class="row valign-wrapper">
                <div class="col s2">
                    <img src="<?= $_self->assetInstance->baseUrl . '/images/virus_covid_corona_rip_dead.svg' ?>" alt="" class="responsive-img"> <!-- notice the "circle" class -->
                </div>
                <div class="col s10">
                    <span class="black-text">
                        <span class="covid-t"><?= Yii::t('app/covid', 'Deaths') ?></span><br>
                        <span class="covid-n"><?=$_self->covidData['deaths']?></span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

