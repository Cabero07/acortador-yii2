<?php
use yii\db\Migration;

/**
 * Handles updates for the `user_log` table.
 */
class m230503_040001_update_user_log_table extends Migration
{
    public function safeUp()
    {
        $tableName = 'user_log';

        // Verificar y agregar columna `action` si no existe
        if (!$this->db->getTableSchema($tableName)->getColumn('action')) {
            $this->addColumn($tableName, 'action', $this->string(255)->notNull()->comment('Acción realizada'));
        }

        // Verificar y agregar columna `performed_by` si no existe
        if (!$this->db->getTableSchema($tableName)->getColumn('performed_by')) {
            $this->addColumn($tableName, 'performed_by', $this->integer()->notNull()->comment('ID del usuario que realizó la acción'));
            $this->createIndex('idx-user_log-performed_by', $tableName, 'performed_by');
            $this->addForeignKey(
                'fk-user_log-performed_by',
                $tableName,
                'performed_by',
                'user',
                'id',
                'CASCADE'
            );
        }

        // Verificar y agregar columna `amount` si no existe
        if (!$this->db->getTableSchema($tableName)->getColumn('amount')) {
            $this->addColumn($tableName, 'amount', $this->decimal(10, 2)->null()->comment('Monto asociado al evento'));
        }

        // Verificar y agregar columna `balance_after` si no existe
        if (!$this->db->getTableSchema($tableName)->getColumn('balance_after')) {
            $this->addColumn($tableName, 'balance_after', $this->decimal(10, 2)->null()->comment('Balance del usuario después del evento'));
        }

        // Verificar y modificar la columna `description` para permitir valores NULL si es necesario
        $descriptionColumn = $this->db->getTableSchema($tableName)->getColumn('description');
        if ($descriptionColumn && !$descriptionColumn->allowNull) {
            $this->alterColumn($tableName, 'description', $this->string(255)->null()->comment('Descripción del evento (opcional)'));
        }
    }

    public function safeDown()
    {
        $tableName = 'user_log';

        // Eliminar las columnas agregadas si existen
        if ($this->db->getTableSchema($tableName)->getColumn('balance_after')) {
            $this->dropColumn($tableName, 'balance_after');
        }

        if ($this->db->getTableSchema($tableName)->getColumn('amount')) {
            $this->dropColumn($tableName, 'amount');
        }

        if ($this->db->getTableSchema($tableName)->getColumn('performed_by')) {
            $this->dropForeignKey('fk-user_log-performed_by', $tableName);
            $this->dropIndex('idx-user_log-performed_by', $tableName);
            $this->dropColumn($tableName, 'performed_by');
        }

        if ($this->db->getTableSchema($tableName)->getColumn('action')) {
            $this->dropColumn($tableName, 'action');
        }

        // Revertir cambios en la columna `description`
        $descriptionColumn = $this->db->getTableSchema($tableName)->getColumn('description');
        if ($descriptionColumn && $descriptionColumn->allowNull) {
            $this->alterColumn($tableName, 'description', $this->string(255)->notNull()->comment('Descripción del evento'));
        }
    }
}