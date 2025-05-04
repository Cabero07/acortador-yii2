<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%intermediate_pages}}`.
 */
class m230504_173500_create_intermediate_pages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%intermediate_pages}}', [
            'id' => $this->primaryKey(),
            'link_id' => $this->integer()->notNull(),
            'views' => $this->integer()->defaultValue(0),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        // Foreign key for `link_id`
        $this->addForeignKey(
            'fk-intermediate_pages-link_id',
            '{{%intermediate_pages}}',
            'link_id',
            '{{%links}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-intermediate_pages-link_id', '{{%intermediate_pages}}');
        $this->dropTable('{{%intermediate_pages}}');
    }
}