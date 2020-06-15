<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%attribute}}`.
 */
class m200615_081701_create_attribute_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%attr}}', [
            'id' => $this->primaryKey(),
            'group' => $this->string(),
            'code' => $this->string()->notNull()
        ]);

        $this->createTable('{{%attr_value}}', [
            'id' => $this->primaryKey(),
            'entity_uuid' => $this->char(36)->notNull(),
            'attr_id' => $this->integer()->notNull(),
            'value' => $this->string()->notNull()
        ]);

        $this->addForeignKey('attr_value-attr_id', 'attr_value', 'attr_id', 'attr', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('attr_value-attr_id', 'attr_value');
        $this->dropTable('{{%attr_value}}');
        $this->dropTable('{{%attr}}');
    }
}
