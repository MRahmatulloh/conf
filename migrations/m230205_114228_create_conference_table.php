<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%conference}}`.
 */
class m230205_114228_create_conference_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%conference}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'accepting_end' => $this->dateTime()->null(),
            'start_date' => $this->dateTime()->notNull(),
            'end_date' => $this->dateTime()->notNull(),
            'description' => $this->text()->null(),
            'short' => $this->text()->null(),
            'responsible_person' => $this->string(255)->null(),
            'responsible_tel' => $this->string(255)->null(),
            'link' => $this->string(255)->null(),
            'filename' => $this->string(255)->null(),
            'place' => $this->string(255)->notNull(),
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
