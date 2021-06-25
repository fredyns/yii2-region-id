<?php

namespace fredyns\region\migrations;

use fredyns\region\models\Postcode;
use yii\db\Migration;

/**
 * Class m210622_215753_import_postcode
 */
class m210622_215753_import_postcode extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $postcodeCount = Postcode::find()->count();
        if ($postcodeCount > 0) {
            echo "{$postcodeCount} postcode found. import skipped.\n";
            return true;
        }

        $this->batchInsert(Postcode::tableName(), ['number', 'subdistrict_id'], require __DIR__ . '/_postcode.php');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210622_215753_import_postcode cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210622_215753_import_postcode cannot be reverted.\n";

        return false;
    }
    */
}
