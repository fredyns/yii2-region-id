<?php

namespace fredyns\region\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%region_city}}`.
 */
class m210616_154346_create_city_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table = '{{%region_city}}';
        $this->createTable($table, [
            'id' => $this->primaryKey(),
            'number' => $this->integer(),
            'name' => $this->string(),
            'province_id' => $this->integer()->defaultValue(null),
        ]);
        $this->createIndex('i_rgn_city_number', $table, 'number');
        $this->createIndex('i_rgn_city_province', $table, 'province_id');
        $this->addForeignKey('fk_rgn_city_province', $table, 'province_id', '{{%region_province}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $table = '{{%region_city}}';
        $this->dropForeignKey('fk_rgn_city_province', $table);
        $this->dropIndex('i_rgn_city_province', $table);
        $this->dropIndex('i_rgn_city_number', $table);
        $this->dropTable($table);
    }
}
