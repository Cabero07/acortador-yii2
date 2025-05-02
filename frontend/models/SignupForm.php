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
    public $email;
    public $phone_number;
    public $password;
    public $referrer_username; // Campo para el nombre de usuario del referido
    public function rules()
    {
        return [
            [['username', 'email', 'phone_number', 'password'], 'required'],
            ['username', 'string', 'min' => 3, 'max' => 20],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este nombre de usuario ya está registrado.'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este correo electrónico ya está registrado.'],
            ['phone_number', 'required'],
            ['phone_number', 'string', 'max' => 15],
            ['phone_number', 'match', 'pattern' => '/^\+?[0-9]*$/', 'message' => 'El número de teléfono solo puede contener dígitos y un signo + opcional al inicio, no deje espacios de por medio.'],
            ['phone_number', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este número de teléfono ya está registrado.'],
            ['password', 'string', 'min' => 6],
            ['referrer_username', 'string', 'max' => 255], // Validación del nombre del referido
            ['referrer_username', 'validateReferrer'], // Validación personalizada
        ];

    }
    /**
     * Validar que el usuario referido exista
     */
    public function validateReferrer($attribute, $params)
    {
        if (!empty($this->referrer_username)) {
            $referrer = User::findOne(['username' => $this->referrer_username]);
            if (!$referrer) {
                $this->addError($attribute, 'El usuario referido no existe.');
            }
        }
    }
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->phone_number = $this->phone_number;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->status = 0; // Asegurarse de que el estado sea inactivo por defecto
        // Asociar el usuario referido si existe
        if (!empty($this->referrer_username)) {
            $referrer = User::findOne(['username' => $this->referrer_username]);
            if ($referrer) {
                $user->referrer_id = $referrer->id;
            }
        }
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
