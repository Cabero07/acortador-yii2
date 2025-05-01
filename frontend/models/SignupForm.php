<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $phone_number;
    public $password;

    public function rules()
    {
        return [
            [['username', 'phone_number', 'password'], 'required'],
            ['username', 'string', 'min' => 3, 'max' => 20],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este nombre de usuario ya está registrado.'],
            ['phone_number', 'string', 'max' => 15],
            ['phone_number', 'match', 'pattern' => '/^\+?[0-9]*$/', 'message' => 'El número de teléfono solo puede contener dígitos y un signo + opcional al inicio, no deje espacios de por medio.'],
            ['phone_number', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este número de teléfono ya está registrado.'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->phone_number = $this->phone_number;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->status = 0; // Asegurarse de que el estado sea inactivo por defecto
        if ($user->save()) {
            $auth = Yii::$app->authManager;
            $role = $auth->getRole('user'); // Verificar si el rol existe
            if ($role) {
                $auth->assign($role, $user->id); // Asignar el rol
            } else {
                throw new \Exception('El rol "user" no existe.');
            }
            return $user;
        }

        return null;
    }
}
