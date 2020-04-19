<?php

namespace app\models\repository;

use PHPHtmlParser\Dom;

class CovidRepository
{
    public static function getCovidData() {
        $dom = new Dom();
        $covidData = [];
        try {
            $dom->loadFromUrl('https://kun.uz');
            $covidData['confirmed'] = ($dom->find('.covid-block__list .covid-block__item div.text span b'))->innerHtml; // confirmed
            $covidData['recovered'] = ($dom->find('.covid-block__list .covid-block__item.i-2 div.text span b'))->innerHtml; // recovered
            $covidData['deaths'] = ($dom->find('.covid-block__list .covid-block__item.i-3 div.text span b'))->innerHtml; // deaths
        } catch (\Exception $e) {
            return [];
        }

        return $covidData;
    }
}