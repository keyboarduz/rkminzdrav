<?php

namespace app\components\widgets\covid19;


use yii\base\InvalidArgumentException;
use yii\base\Widget;

class Covid19 extends Widget
{
    public $covidData;
    public $cardImage = true;

    public function init()
    {
        parent::init();

        if ($this->covidData === null || !is_array($this->covidData)) {
            throw new InvalidArgumentException('undefined "covidData"');
        } elseif (!isset($this->covidData['confirmed'], $this->covidData['recovered'], $this->covidData['deaths'])) {
            throw new InvalidArgumentException('undefined "confirmed" or "recovered" or "deaths"');
        }
    }

    public function run()
    {
        return $this->render('covid-card', [
            '_self' => $this,
        ]);
    }
}