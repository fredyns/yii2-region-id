<?php

namespace fredyns\region\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%region_province}}`.
 */
class m210616_152002_create_province_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table = '{{%region_province}}';
        $this->createTable($table, [
            'id' => $this->primaryKey(),
            'number' => $this->integer()->defaultValue(null),
            'name' => $this->string(),
        ]);
        $this->createIndex('i_rgn_province_number', $table, 'number');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $table = '{{%region_province}}';
        $this->dropIndex('i_rgn_province_number', $table);
        $this->dropTable($table);
    }
}
