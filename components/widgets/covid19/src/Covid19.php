<?php

namespace app\components\widgets\covid19\src;


use yii\base\InvalidArgumentException;
use yii\base\Widget;

class Covid19 extends Widget
{
    public $covidData;
    public $cardImage = true;
    /** @var Covid19Asset */
    public $assetInstance;

    public function init()
    {
        parent::init();
        $this->assetInstance = Covid19Asset::register($this->getView());

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