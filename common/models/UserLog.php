<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Modelo para la tabla `user_log`.
 *
 * @property int $id Identificador único del log
 * @property int $user_id ID del usuario afectado
 * @property string $action Acción realizada (habilitar, deshabilitar, cambiar rol, ganar dinero, retirar dinero, etc.)
 * @property int $performed_by ID del usuario que realizó la acción (administrador o sistema)
 * @property string|null $description Descripción adicional del evento
 * @property float|null $amount Monto asociado al evento (positivo para ganancias, negativo para retiros)
 * @property float|null $balance_after Balance del usuario después del evento
 * @property string $created_at Fecha y hora del evento
 */
class UserLog extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'action', 'performed_by'], 'required'], // Campos obligatorios para todas las acciones
            [['user_id', 'performed_by'], 'integer'], // IDs deben ser enteros
            [['amount', 'balance_after'], 'number'], // Campos numéricos, opcionales
            [['created_at'], 'safe'], // Fecha
            [['action', 'description'], 'string', 'max' => 255], // Textos con límite de 255 caracteres
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Usuario Afectado',
            'action' => 'Acción Realizada',
            'performed_by' => 'Realizado Por',
            'description' => 'Descripción',
            'amount' => 'Monto',
            'balance_after' => 'Balance Después',
            'created_at' => 'Fecha de Evento',
        ];
    }

    /**
     * Relación con el modelo User para el usuario afectado.
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Relación con el modelo User para el usuario que realizó la acción.
     */
    public function getPerformedBy()
    {
        return $this->hasOne(User::class, ['id' => 'performed_by']);
    }

    /**
     * Filtrar logs por ganancias o retiros.
     * 
     * @param int $userId ID del usuario
     * @return \yii\db\ActiveQuery
     */
    public static function getBalanceLogs($userId)
    {
        return self::find()
            ->where(['user_id' => $userId])
            ->andWhere(['in', 'action', ['Ganar Dinero', 'Retirar Dinero']])
            ->orderBy(['created_at' => SORT_DESC]);
    }
}
