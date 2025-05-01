<?php
use yii\db\Migration;

/**
 * Class m230501000001_add_referrer_id_to_user_table
 */
class m230501000001_add_referrer_id_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'referrer_id', $this->integer()->null()->after('id'));

        // Crear una clave foránea para asegurar la integridad referencial
        $this->addForeignKey(
            'fk-user-referrer_id',
            '{{%user}}',
            'referrer_id',
            '{{%user}}',
            'id',
            'SET NULL',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-user-referrer_id', '{{%user}}');
        $this->dropColumn('{{%user}}', 'referrer_id');
    }
}