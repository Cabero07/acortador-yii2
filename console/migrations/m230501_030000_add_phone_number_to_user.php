<?php

use yii\db\Migration;

/**
 * Class m230501_030000_add_phone_number_to_user
 */
class m230501_030000_add_phone_number_to_user extends Migration
{
    public function safeUp()
    {
        // Agregar columna phone_number a la tabla user
        $this->addColumn('{{%user}}', 'phone_number', $this->string(15)->defaultValue(null)->comment('Número de teléfono del usuario'));
    }

    public function safeDown()
    {
        // Eliminar columna phone_number en caso de revertir la migración
        $this->dropColumn('{{%user}}', 'phone_number');
    }
}