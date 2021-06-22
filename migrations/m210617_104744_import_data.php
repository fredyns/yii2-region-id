<?php

namespace fredyns\region\migrations;

use fredyns\region\models\City;
use fredyns\region\models\District;
use fredyns\region\models\Province;
use fredyns\region\models\Subdistrict;
use yii\db\Migration;

/**
 * Class m210617_104744_import_data
 */
class m210617_104744_import_data extends Migration
{
    const DIVIDER_PROVINCE = 100;
    const DIVIDER_CITY = 100;
    const DIVIDER_DISTRICT = 10000;

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $provinceCount = Province::find()->count();
        if ($provinceCount > 0) {
            echo "data already exist. import skipped.\n";
            return true;
        }

        $limitProvince = 100;
        $limitCity = 10000;
        $limitDistrict = 1000000;
        $data = require __DIR__ . '/_region_2020.php';
        foreach ($data as $number => $name) {

            if ($number < $limitProvince) {
                $this->insertProvince($number, $name);

            } else if ($number < $limitCity) {
                $this->insertCity($number, $name);

            } else if ($number < $limitDistrict) {
                $this->insertDistrict($number, $name);

            } else {
                $this->populateSubdistrict($number, $name);
            }
        }

        if ($this->db->driverName === 'pgsql') {
            echo "set pgsql sequence (autoincrement) manually.\n";
        }
    }

    private function insertProvince($number, $name)
    {
        $this->insertSubdistrict();
        $this->insert(Province::tableName(), [
            'id' => $number,
            'number' => $number,
            'name' => $name,
        ]);
    }

    private function insertCity($number, $name)
    {
        $this->insertSubdistrict();
        $this->insert(City::tableName(), [
            'id' => $number,
            'number' => $number,
            'name' => $name,
            'province_id' => floor($number / static::DIVIDER_PROVINCE),
        ]);
    }

    private function insertDistrict($number, $name)
    {
        $this->insertSubdistrict();
        $this->insert(District::tableName(), [
            'id' => $number,
            'number' => $number,
            'name' => $name,
            'city_id' => floor($number / static::DIVIDER_CITY),
        ]);
    }

    private function populateSubdistrict($number, $name)
    {
        static::$subdistricts[] = [
            'id' => $number,
            'number' => $number,
            'name' => $name,
            'district_id' => floor($number / static::DIVIDER_DISTRICT),
        ];
    }

    private static $subdistricts = [];

    private function insertSubdistrict()
    {
        if (empty(static::$subdistricts)) {
            return;
        }

        $this->batchInsert(Subdistrict::tableName(), ['id', 'number', 'name', 'district_id'], static::$subdistricts);
        static::$subdistricts = [];
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210617_104744_import_data cannot be reverted.\n";
        return true;
    }

}
