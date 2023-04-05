<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%conference}}`.
 */
class m230405_114228_create_conference_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%conference}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'start_date' => $this->date()->notNull(),
            'end_date' => $this->date()->notNull(),
            'description' => $this->text()->null(),
            'link' => $this->string(255)->null(),
            'filename' => $this->string(255)->null(),
            'status' => $this->integer()->defaultValue(1),
            'created_at' => $this->integer()->null(),
            'updated_at' => $this->integer()->null(),
            'created_by' => $this->integer()->null(),
            'updated_by' => $this->integer()->null()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%conference}}');
    }
}
