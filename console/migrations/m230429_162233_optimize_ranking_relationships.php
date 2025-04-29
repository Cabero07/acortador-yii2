<?php

use yii\db\Migration;

/**
 * Class m230429_162233_optimize_ranking_relationships
 */
class m230429_162233_optimize_ranking_relationships extends Migration
{
    public function safeUp()
    {
        // Verificar y agregar índices necesarios
        $this->createIndex(
            'idx-links-user_id',
            '{{%links}}',
            'user_id'
        );

        $this->createIndex(
            'idx-link_stats-link_id',
            '{{%link_stats}}',
            'link_id'
        );

        // Verificar relaciones
        $this->addForeignKey(
            'fk-links-user_id',
            '{{%links}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-link_stats-link_id',
            '{{%link_stats}}',
            'link_id',
            '{{%links}}',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        // Eliminar relaciones
        $this->dropForeignKey('fk-links-user_id', '{{%links}}');
        $this->dropForeignKey('fk-link_stats-link_id', '{{%link_stats}}');

        // Eliminar índices
        $this->dropIndex('idx-links-user_id', '{{%links}}');
        $this->dropIndex('idx-link_stats-link_id', '{{%link_stats}}');
    }
}