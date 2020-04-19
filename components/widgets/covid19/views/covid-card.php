<?php
/** @var array $covidData */
?>
<div class="card hoverable">
    <div class="card-image">
        <img src="/images/covid.jpeg">
    </div>
    <div class="card-content">
        <span class="card-title">
            Коронавирус Ўзбекистонда
        </span>
        <ul class="collection">
            <li class="collection-item avatar red-text">
                <i class="material-icons circle red">sentiment_dissatisfied</i>
                <span class="title"><?= Yii::t('app/covid', 'Confirmed') ?></span>
                <p>
                    <span class="covid-n"><?=$covidData['confirmed']?></span>
                </p>
            </li>
            <li class="collection-item avatar green-text">
                <i class="material-icons circle green">sentiment_very_satisfied</i>
                <span class="title"><?= Yii::t('app/covid', 'Recovered') ?></span>
                <p>
                    <span class="covid-n"><?=$covidData['recovered']?></span>
                </p>
            </li>
            <li class="collection-item avatar">
                <i class="material-icons circle">sentiment_very_dissatisfied</i>
                <span class="title"><?= Yii::t('app/covid', 'Deaths') ?></span>
                <p>
                    <span class="covid-n"><?=$covidData['deaths']?></span>
                </p>
            </li>
        </ul>
    </div>
</div>

