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

        // Guardar en un archivo o base de datos si es necesario
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