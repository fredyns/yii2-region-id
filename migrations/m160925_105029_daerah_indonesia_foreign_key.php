<?php

use yii\db\Migration;

class m160925_105029_daerah_indonesia_foreign_key extends Migration
{

    public function up()
    {
        // create index

        $this->createIndex('idx-provinsi-nomor', 'drhidn_provinsi', 'nomor');

        $this->createIndex('idx-kota-nomor', 'drhidn_kota', 'nomor');

        $this->createIndex('idx-kecamatan-nomor', 'drhidn_kecamatan', 'nomor');

        $this->createIndex('idx-kelurahan-nomor', 'drhidn_kelurahan', 'nomor');

        $this->createIndex('idx-kodepos-nomor', 'drhidn_kodepos', 'nomor');

        $this->createIndex('fk-kota-provinsi', 'drhidn_kota', 'provinsi_id');

        $this->createIndex('fk-kecamatan-kota', 'drhidn_kecamatan', 'kota_id');

        $this->createIndex('fk-kelurahan-kecamatan', 'drhidn_kelurahan', 'kecamatan_id');

        $this->createIndex('fk-kodepos-provinsi', 'drhidn_kodepos', 'provinsi_id');

        $this->createIndex('fk-kodepos-kota', 'drhidn_kodepos', 'kota_id');

        $this->createIndex('fk-kodepos-kecamatan', 'drhidn_kodepos', 'kecamatan_id');

        $this->createIndex('fk-kodepos-kelurahan', 'drhidn_kodepos', 'kelurahan_id');

        // add foreign key

        $this->addForeignKey(
            'fk-kota-provinsi', 'drhidn_kota', 'provinsi_id', 'drhidn_provinsi', 'id', 'NO ACTION', 'NO ACTION'
        );

        $this->addForeignKey(
            'fk-kecamatan-kota', 'drhidn_kecamatan', 'kota_id', 'drhidn_kota', 'id', 'NO ACTION', 'NO ACTION'
        );

        $this->addForeignKey(
            'fk-kelurahan-kecamatan', 'drhidn_kelurahan', 'kecamatan_id', 'drhidn_kecamatan', 'id', 'NO ACTION',
            'NO ACTION'
        );

        $this->addForeignKey(
            'fk-kodepos-provinsi', 'drhidn_kodepos', 'provinsi_id', 'drhidn_provinsi', 'id', 'NO ACTION', 'NO ACTION'
        );

        $this->addForeignKey(
            'fk-kodepos-kota', 'drhidn_kodepos', 'kota_id', 'drhidn_kota', 'id', 'NO ACTION', 'NO ACTION'
        );

        $this->addForeignKey(
            'fk-kodepos-kecamatan', 'drhidn_kodepos', 'kecamatan_id', 'drhidn_kecamatan', 'id', 'NO ACTION', 'NO ACTION'
        );

        $this->addForeignKey(
            'fk-kodepos-kelurahan', 'drhidn_kodepos', 'kelurahan_id', 'drhidn_kelurahan', 'id', 'NO ACTION', 'NO ACTION'
        );
    }

    public function down()
    {
        // drop foreign key

        $this->dropForeignKey('fk-kota-provinsi', 'drhidn_kota');
        $this->dropForeignKey('fk-kecamatan-kota', 'drhidn_kecamatan');
        $this->dropForeignKey('fk-kelurahan-kecamatan', 'drhidn_kelurahan');
        $this->dropForeignKey('fk-kodepos-provinsi', 'drhidn_kodepos');
        $this->dropForeignKey('fk-kodepos-kota', 'drhidn_kodepos');
        $this->dropForeignKey('fk-kodepos-kecamatan', 'drhidn_kodepos');
        $this->dropForeignKey('fk-kodepos-kelurahan', 'drhidn_kodepos');

        // drop index

        $this->dropIndex('fk-kota-provinsi', 'drhidn_kota');
        $this->dropIndex('fk-kecamatan-kota', 'drhidn_kecamatan');
        $this->dropIndex('fk-kelurahan-kecamatan', 'drhidn_kelurahan');
        $this->dropIndex('fk-kodepos-provinsi', 'drhidn_kodepos');
        $this->dropIndex('fk-kodepos-kota', 'drhidn_kodepos');
        $this->dropIndex('fk-kodepos-kecamatan', 'drhidn_kodepos');
        $this->dropIndex('fk-kodepos-kelurahan', 'drhidn_kodepos');

        $this->dropIndex('idx-provinsi-nomor', 'drhidn_provinsi');
        $this->dropIndex('idx-kota-nomor', 'drhidn_kota');
        $this->dropIndex('idx-kecamatan-nomor', 'drhidn_kecamatan');
        $this->dropIndex('idx-kelurahan-nomor', 'drhidn_kelurahan');
        $this->dropIndex('idx-kodepos-nomor', 'drhidn_kodepos');
    }

}