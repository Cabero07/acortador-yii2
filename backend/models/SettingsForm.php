<?php

namespace backend\models;

use Yii;
use yii\base\Model;

class SettingsForm extends Model
{
    public $exchange_rate_cup;
    public $exchange_rate_mlc;

    public function rules()
    {
        return [
            [['exchange_rate_cup', 'exchange_rate_mlc'], 'required'],
            [['exchange_rate_cup', 'exchange_rate_mlc'], 'number', 'min' => 0.01],
        ];
    }

    public function save()
    {
        Yii::$app->params['exchange_rate_cup'] = $this->exchange_rate_cup;
        Yii::$app->params['exchange_rate_mlc'] = $this->exchange_rate_mlc;

        $paramsFile = Yii::getAlias('@common/config/params.php');
        $params = include $paramsFile;
        $params['exchange_rate_cup'] = $this->exchange_rate_cup;
        $params['exchange_rate_mlc'] = $this->exchange_rate_mlc;

        $content = '<?php return ' . var_export($params, true) . ';';
        file_put_contents($paramsFile, $content);

        return true;
    }

    public function init()
    {
        parent::init();
        $this->exchange_rate_cup = Yii::$app->params['exchange_rate_cup'] ?? 24.0;
        $this->exchange_rate_mlc = Yii::$app->params['exchange_rate_mlc'] ?? 1.0;
    }
}