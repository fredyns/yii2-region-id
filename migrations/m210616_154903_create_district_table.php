<?php

namespace fredyns\region\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%region_district}}`.
 */
class m210616_154903_create_district_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table = '{{%region_district}}';
        $this->createTable($table, [
            'id' => $this->primaryKey(),
            'number' => $this->integer()->defaultValue(null),
            'name' => $this->string(),
            'city_id' => $this->integer()->defaultValue(null),
        ]);
        $this->createIndex('i_rgn_district_number', $table, 'number');
        $this->createIndex('i_rgn_district_city', $table, 'city_id');
        $this->addForeignKey('fk_rgn_district_city', $table, 'city_id', '{{%region_city}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $table = '{{%region_district}}';
        $this->dropForeignKey('fk_rgn_district_city', $table);
        $this->dropIndex('i_rgn_district_city', $table);
        $this->dropIndex('i_rgn_district_number', $table);
        $this->dropTable($table);
    }
}
