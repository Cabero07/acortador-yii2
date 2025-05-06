<?php

namespace backend\models;

use Yii;
use yii\base\Model;

class AdminOptions extends Model
{
    public $ad_display_time;
    public $adskeeper_code;
    public $click_tracking_enabled;

    public function rules()
    {
        return [
            [['ad_display_time'], 'integer', 'min' => 1],
            [['adskeeper_code'], 'string'],
            [['click_tracking_enabled'], 'boolean'],
        ];
    }

    public function save()
    {
        Yii::$app->settings->set('ad_display_time', $this->ad_display_time);
        Yii::$app->settings->set('adskeeper_code', $this->adskeeper_code);
        Yii::$app->settings->set('click_tracking_enabled', $this->click_tracking_enabled);
        return true;
    }

    public function loadSettings()
    {
        $this->ad_display_time = Yii::$app->settings->get('ad_display_time', 5);
        $this->adskeeper_code = Yii::$app->settings->get('adskeeper_code', '');
        $this->click_tracking_enabled = Yii::$app->settings->get('click_tracking_enabled', true);
    }
}