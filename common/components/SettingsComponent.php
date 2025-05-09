<?php

namespace common\components;

use Yii;
use yii\base\Component;
use yii\db\Query;

class SettingsComponent extends Component
{
    private $cache = [];

    /**
     * Obtener una configuración.
     */
    public function get($key, $default = null)
    {
        if (isset($this->cache[$key])) {
            return $this->cache[$key];
        }

        $value = (new Query())
            ->select(['value'])
            ->from('{{%settings}}')
            ->where(['key' => $key])
            ->scalar();

        if ($value === false) {
            return $default;
        }

        $this->cache[$key] = $value;
        return $value;
    }

    /**
     * Establecer una configuración.
     */
    public function set($key, $value)
    {
        Yii::$app->db->createCommand()
            ->upsert('{{%settings}}', ['key' => $key, 'value' => $value])
            ->execute();

        $this->cache[$key] = $value;
    }

    public function getExchangeRate($method)
    {
        switch ($method) {
            case 'CUP':
                return $this->get('exchange_rate_cup', 24.0);

            case 'MLC':
                return $this->get('exchange_rate_mlc', 1.0);

            case 'QVAPAY':
            default:
                return 1.0;
        }
    }
}
