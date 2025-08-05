<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%click}}`.
 */
class m250805_062124_create_click_table extends Migration
{
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE click (
                id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
                url_id INT NOT NULL REFERENCES url(id) ON DELETE CASCADE,
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                user_agent TEXT NOT NULL
            );
        ");
    }

    public function safeDown()
    {
        $this->dropTable('clicks');
    }
}
