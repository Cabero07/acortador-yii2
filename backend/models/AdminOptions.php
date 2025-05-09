<?php

namespace backend\models;

use Yii;
use yii\base\Model;

class AdminOptions extends Model
{
    public $ad_display_time;
    public $adskeeper_code;
    public $click_tracking_enabled;
    public $own_click_earning; 
    public $referral_click_earning; 
    public $exchange_rate_cup;
    public $exchange_rate_mlc;
    public function rules()
    {
        return [
            [['ad_display_time'], 'integer', 'min' => 1],
            [['adskeeper_code'], 'string'],
            [['click_tracking_enabled'], 'boolean'],
            [['own_click_earning', 'referral_click_earning'], 'number', 'min' => 0], 
        ];
    }

    public function save()
    {
        Yii::$app->settings->set('ad_display_time', $this->ad_display_time);
        Yii::$app->settings->set('adskeeper_code', $this->adskeeper_code);
        Yii::$app->settings->set('click_tracking_enabled', $this->click_tracking_enabled ? '1' : '0');
        Yii::$app->settings->set('own_click_earning', $this->own_click_earning); 
        Yii::$app->settings->set('referral_click_earning', $this->referral_click_earning); 
        Yii::$app->settings->set('exchange_rate_cup', $this->exchange_rate_cup);
        Yii::$app->settings->set('exchange_rate_mlc', $this->exchange_rate_mlc);
        return true;
    }

    public function loadSettings()
    {
        $this->ad_display_time = Yii::$app->settings->get('ad_display_time', 5);
        $this->adskeeper_code = Yii::$app->settings->get('adskeeper_code', '');
        $this->click_tracking_enabled = Yii::$app->settings->get('click_tracking_enabled', '1') === '1';
        $this->own_click_earning = Yii::$app->settings->get('own_click_earning', 0.004); 
        $this->referral_click_earning = Yii::$app->settings->get('referral_click_earning', 0.002); 
        $this->exchange_rate_cup = Yii::$app->settings->get('exchange_rate_cup', 24.0); 
        $this->exchange_rate_mlc = Yii::$app->settings->get('exchange_rate_mlc', 1.0); 
    }
}