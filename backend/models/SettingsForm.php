<?php

namespace backend\models;

use Yii;
use yii\base\Model;

class SettingsForm extends Model
{
    public $linkLimitPerUser;

    public function rules()
    {
        return [
            [['linkLimitPerUser'], 'required'],
            [['linkLimitPerUser'], 'integer', 'min' => 1],
        ];
    }

    public function save()
    {
        Yii::$app->params['linkLimitPerUser'] = $this->linkLimitPerUser;

        // Opcional: guardar en base de datos u otro lugar si es dinámico
        $paramsFile = Yii::getAlias('@common/config/params.php');
        $params = include $paramsFile;
        $params['linkLimitPerUser'] = $this->linkLimitPerUser;

        $content = '<?php return ' . var_export($params, true) . ';';
        file_put_contents($paramsFile, $content);

        return true;
    }

    public function init()
    {
        parent::init();
        $this->linkLimitPerUser = Yii::$app->params['linkLimitPerUser'] ?? 10; // Valor por defecto
    }
}