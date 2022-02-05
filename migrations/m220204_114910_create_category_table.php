<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m220204_114910_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'name_hy' => $this->string(),
            'name_ru' => $this->string(),
            'name_en' => $this->string(),
            'status' => $this->smallInteger(),
            'parent_id' => $this->integer(),
            'created_date' => $this->dateTime(),
            'updated_date' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category}}');
    }
}
