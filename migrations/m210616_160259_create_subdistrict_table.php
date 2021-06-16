<?php

namespace fredyns\region\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%region_subdistrict}}`.
 */
class m210616_160259_create_subdistrict_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table = '{{%region_subdistrict}}';
        $this->createTable($table, [
            'id' => $this->primaryKey(),
            'number' => $this->integer(),
            'name' => $this->string(),
            'district_id' => $this->integer()->defaultValue(null),
        ]);
        $this->createIndex('i_rgn_subdistrict_number', $table, 'number');
        $this->createIndex('i_rgn_subdistrict_district', $table, 'district_id');
        $this->addForeignKey('fk_rgn_subdistrict_district', $table, 'district_id', '{{%region_district}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $table = '{{%region_subdistrict}}';
        $this->dropForeignKey('fk_rgn_subdistrict_district', $table);
        $this->dropIndex('i_rgn_subdistrict_district', $table);
        $this->dropIndex('i_rgn_subdistrict_number', $table);
        $this->dropTable($table);
    }
}
