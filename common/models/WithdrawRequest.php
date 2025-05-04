<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "withdraw_requests".
 *
 * @property int $id
 * @property int $user_id
 * @property float $amount
 * @property string $payment_method
 * @property string $details
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 */
class WithdrawRequest extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%withdraw_requests}}';
    }

    public function rules()
    {
        return [
            [['user_id', 'amount', 'payment_method', 'details'], 'required'],
            [['user_id'], 'integer'],
            [['amount'], 'number', 'min' => 10], // Enforce $10 minimum
            [['payment_method'], 'in', 'range' => ['CUP', 'MLC', 'QVAPAY']],
            [['details'], 'string', 'max' => 255],
            [['status'], 'in', 'range' => ['pendiente', 'aprobado', 'completado', 'rechazado']],
            ['details', 'validateDetails'],
        ];
    }

    public function validateDetails($attribute, $params)
    {
        if (in_array($this->payment_method, ['CUP', 'MLC'])) {
            if (!preg_match('/^(\d{4}-){3}\d{4}$/', $this->details)) {
                $this->addError($attribute, 'El número de tarjeta debe tener 16 dígitos separados por guiones (ejemplo: 1234-5678-9012-3456).');
            }
        }

        if ($this->payment_method === 'QVAPAY') {
            if (!filter_var($this->details, FILTER_VALIDATE_EMAIL)) {
                $this->addError($attribute, 'El correo electrónico no es válido.');
            }
        }
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Usuario',
            'amount' => 'Monto',
            'payment_method' => 'Método de Pago',
            'details' => 'Detalles del Pago',
            'status' => 'Estado',
            'created_at' => 'Fecha de Creación',
            'updated_at' => 'Última Actualización',
        ];
    }

    public function getConversionRate()
    {
        if ($this->payment_method === 'CUP') {
            return 340; // 340 CUP per dollar
        } elseif ($this->payment_method === 'MLC') {
            return 1.2; // 1.2 MLC per dollar
        }

        return 1; // Default for USD or other methods
    }
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
