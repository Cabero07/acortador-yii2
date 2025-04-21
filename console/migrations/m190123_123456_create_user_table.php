<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m190123_123456_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(50)->notNull()->unique()->comment('Nombre de usuario único'),
            'email' => $this->string(100)->notNull()->unique()->comment('Correo electrónico único'),
            'password_hash' => $this->string()->notNull()->comment('Hash de la contraseña'),
            'auth_key' => $this->string(32)->notNull()->comment('Clave de autenticación para sesiones'),
            'access_token' => $this->string(32)->defaultValue(null)->comment('Token de acceso para APIs'),
            'status' => $this->tinyInteger(1)->notNull()->defaultValue(1)->comment('Estado del usuario: 1=activo, 0=inactivo, -1=deshabilitado'),
            'created_links_count' => $this->integer()->notNull()->defaultValue(0)->comment('Número de enlaces creados por el usuario'),
            'balance' => $this->decimal(10, 2)->notNull()->defaultValue(0.00)->comment('Balance acumulado del usuario por ingresos'),
            'role' => $this->string(20)->notNull()->defaultValue('user')->comment('Rol del usuario: user o admin'),
            'profile_picture' => $this->string(255)->defaultValue(null)->comment('URL de la imagen de perfil'),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->comment('Fecha de creación'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')->comment('Fecha de última actualización'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}