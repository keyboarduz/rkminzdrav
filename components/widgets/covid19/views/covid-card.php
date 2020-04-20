<?php
/** @var \app\components\widgets\covid19\Covid19 $_self */
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
        <ul class="collection">
            <li class="collection-item avatar red-text">
                <i class="material-icons circle red">sentiment_dissatisfied</i>
                <span class="title"><?= Yii::t('app/covid', 'Confirmed') ?></span>
                <p>
                    <span class="covid-n"><?=$_self->covidData['confirmed']?></span>
                </p>
            </li>
            <li class="collection-item avatar green-text">
                <i class="material-icons circle green">sentiment_very_satisfied</i>
                <span class="title"><?= Yii::t('app/covid', 'Recovered') ?></span>
                <p>
                    <span class="covid-n"><?=$_self->covidData['recovered']?></span>
                </p>
            </li>
            <li class="collection-item avatar">
                <i class="material-icons circle">sentiment_very_dissatisfied</i>
                <span class="title"><?= Yii::t('app/covid', 'Deaths') ?></span>
                <p>
                    <span class="covid-n"><?=$_self->covidData['deaths']?></span>
                </p>
            </li>
        </ul>
    </div>
</div>

