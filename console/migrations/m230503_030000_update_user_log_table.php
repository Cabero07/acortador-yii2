<?php
use yii\db\Migration;

/**
 * Handles updates for the `user_log` table.
 */
class m230503_030000_update_user_log_table extends Migration
{
    public function safeUp()
    {
        $table = 'user_log';

        // Validar y agregar columna `action` si no existe
        if (!$this->db->getTableSchema($table)->getColumn('action')) {
            $this->addColumn($table, 'action', $this->string(255)->notNull()->comment('Acción realizada'));
        }

        // Validar y agregar columna `performed_by` si no existe
        if (!$this->db->getTableSchema($table)->getColumn('performed_by')) {
            $this->addColumn($table, 'performed_by', $this->integer()->notNull()->comment('ID del usuario que realizó la acción'));
            
            // Crear índice y clave foránea para `performed_by`
            $this->createIndex('idx-user_log-performed_by', $table, 'performed_by');
            $this->addForeignKey(
                'fk-user_log-performed_by',
                $table,
                'performed_by',
                'user',
                'id',
                'CASCADE'
            );
        }

        // Modificar la columna `description` si es necesario
        $descriptionColumn = $this->db->getTableSchema($table)->getColumn('description');
        if ($descriptionColumn && $descriptionColumn->allowNull === false) {
            $this->alterColumn($table, 'description', $this->string(255)->null()->comment('Descripción del evento (opcional)'));
        }
    }

    public function safeDown()
    {
        $table = 'user_log';

        // Revertir cambios realizados en la tabla `user_log`
        if ($this->db->getTableSchema($table)->getColumn('performed_by')) {
            $this->dropForeignKey('fk-user_log-performed_by', $table);
            $this->dropIndex('idx-user_log-performed_by', $table);
            $this->dropColumn($table, 'performed_by');
        }

        if ($this->db->getTableSchema($table)->getColumn('action')) {
            $this->dropColumn($table, 'action');
        }

        $descriptionColumn = $this->db->getTableSchema($table)->getColumn('description');
        if ($descriptionColumn && $descriptionColumn->allowNull === true) {
            $this->alterColumn($table, 'description', $this->string(255)->notNull()->comment('Descripción del evento'));
        }
    }
}