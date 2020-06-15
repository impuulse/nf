<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%entity}}`.
 */
class m200615_080253_create_entity_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%entity}}', [
            'id' => $this->primaryKey(),
            'uuid' => $this->char(36)->unique()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%entity}}');
    }
}
