<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_log}}`.
 */
class m230422_012130_create_user_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_log}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(), // Usuario afectado
            'action' => $this->string(255)->notNull(), // Acción realizada
            'performed_by' => $this->integer()->notNull(), // Administrador que realizó la acción
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'), // Fecha y hora de la acción
        ]);

        // Crear índices y claves foráneas
        $this->addForeignKey(
            'fk-user_log-user_id',
            '{{%user_log}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-user_log-performed_by',
            '{{%user_log}}',
            'performed_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-user_log-user_id', '{{%user_log}}');
        $this->dropForeignKey('fk-user_log-performed_by', '{{%user_log}}');
        $this->dropTable('{{%user_log}}');
    }
}