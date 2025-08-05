<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%url}}`.
 */
class m250805_062025_create_url_table extends Migration
{
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE url (
                id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
                original_url TEXT NOT NULL,
                short_code VARCHAR(255) NOT NULL UNIQUE,
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
            );
        ");
    }

    public function safeDown()
    {
        $this->dropTable('url');
    }
}
