<?php

namespace fredyns\region\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%region_postcode}}`.
 */
class m210616_160639_create_postcode_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table = '{{%region_postcode}}';
        $this->createTable($table, [
            'id' => $this->bigPrimaryKey(),
            'number' => $this->integer(),
            'subdistrict_id' => $this->bigInteger()->defaultValue(null),
        ]);
        $this->createIndex('i_rgn_postcode_number', $table, 'number');
        $this->createIndex('i_rgn_postcode_subdistrict', $table, 'subdistrict_id');
        $this->addForeignKey('fk_rgn_postcode_subdistrict', $table, 'subdistrict_id', '{{%region_subdistrict}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $table = '{{%region_postcode}}';
        $this->dropForeignKey('fk_rgn_postcode_subdistrict', $table);
        $this->dropIndex('i_rgn_postcode_subdistrict', $table);
        $this->dropIndex('i_rgn_postcode_number', $table);
        $this->dropTable($table);
    }
}
