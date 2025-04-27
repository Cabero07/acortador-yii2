<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%links}}`.
 */
class m230427_050000_add_user_id_to_links extends Migration
{
    public function safeUp()
    {
        // Verificar si la columna ya existe
        if ($this->db->getTableSchema('{{%links}}')->getColumn('user_id') === null) {
            // Agregar columna user_id si no existe
            $this->addColumn('{{%links}}', 'user_id', $this->integer()->comment('ID del usuario que creó el enlace'));

            // Asignar un valor por defecto para los registros existentes
            $this->update('{{%links}}', ['user_id' => 1]); // Asignar un ID de usuario válido (por ejemplo, 1)

            // Crear clave foránea para relacionar con la tabla `user`
            $this->addForeignKey(
                'fk-links-user_id',
                '{{%links}}',
                'user_id',
                '{{%user}}',
                'id',
                'CASCADE'
            );
        } else {
            echo "La columna 'user_id' ya existe en la tabla 'links'.\n";
        }
    }

    public function safeDown()
    {
        if ($this->db->getTableSchema('{{%links}}')->getColumn('user_id') !== null) {
            $this->dropForeignKey('fk-links-user_id', '{{%links}}');
            $this->dropColumn('{{%links}}', 'user_id');
        }
    }
}