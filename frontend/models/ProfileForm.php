<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * ProfileForm es el modelo para actualizar el perfil del usuario.
 */
class ProfileForm extends Model
{
    public $email;
    public $phone_number;

    public function rules()
    {
        return [
            [['email', 'phone_number'], 'required'],
            ['email', 'email', 'message' => 'El correo no es válido.'],
            ['phone_number', 'string', 'max' => 15],
            ['phone_number', 'match', 'pattern' => '/^\+?[0-9]*$/', 'message' => 'El número de teléfono solo puede contener dígitos y un signo + opcional al inicio.'],
        ];
    }

    public function saveProfile()
    {
        $user = Yii::$app->user->identity;

        if (!$user) {
            return false;
        }

        $user->email = $this->email;
        $user->phone_number = $this->phone_number;

        return $user->save(false); // Guardar sin validaciones adicionales
    }
}