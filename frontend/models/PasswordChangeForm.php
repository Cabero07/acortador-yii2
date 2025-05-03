<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

class PasswordChangeForm extends Model
{
    public $current_password;
    public $new_password;
    public $confirm_password;

    public function rules()
    {
        return [
            [['current_password', 'new_password', 'confirm_password'], 'required'],
            [['current_password'], 'validateCurrentPassword'],
            [['new_password'], 'string', 'min' => 8],
            [['confirm_password'], 'compare', 'compareAttribute' => 'new_password', 'message' => 'Las contraseñas no coinciden.'],
        ];
    }

    public function validateCurrentPassword($attribute, $params)
    {
        if (!Yii::$app->security->validatePassword($this->current_password, Yii::$app->user->identity->password_hash)) {
            $this->addError($attribute, 'La contraseña actual es incorrecta.');
        }
    }

    public function changePassword()
    {
        $user = User::findOne(Yii::$app->user->id);
        $user->password_hash = Yii::$app->security->generatePasswordHash($this->new_password);

        return $user->save(false);
    }
}