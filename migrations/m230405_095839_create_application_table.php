<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%application}}`.
 */
class m230405_095839_create_application_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%application}}', [
            'id' => $this->primaryKey(),
            'conference_id' => $this->integer()->notNull(),
            'sender_first_name' => $this->string(255)->notNull(),
            'sender_last_name' => $this->string(255)->notNull(),
            'owners' => $this->text()->null(),
            'category_id' => $this->integer()->notNull(),
            'article_name' => $this->string(255)->notNull(),
            'comment' => $this->text()->null(),
            'phone' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull(),
            'is_first' => $this->boolean()->defaultValue(true),
            'status' => $this->integer()->defaultValue(1),
            'link' => $this->string(255)->null(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->null(),
            'updated_by' => $this->integer()->null(),
        ]);

        $this->createIndex(
            'idx-application-conference_id',
            'application',
            'conference_id'
        );

        $this->addForeignKey(
            'fk-application-conference_id',
            'application',
            'conference_id',
            'conference',
            'id',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%application}}');
    }
}
