<?php

use yii\db\Migration;

class m160925_101940_daerah_indonesia_create_table extends Migration
{

    public function up()
    {
        $this->createTable('drhidn_provinsi',
            [
            'id'         => $this->primaryKey()->unsigned(),
            'nomor'      => $this->string(32),
            'nama'       => $this->string(255)->notNull(),
            'singkatan'  => $this->string(32),
            'created_at' => $this->integer(10)->unsigned(),
            'updated_at' => $this->integer(10)->unsigned(),
            'created_by' => $this->integer(10)->unsigned(),
            'updated_by' => $this->integer(10)->unsigned(),
        ]);

        $this->createTable('drhidn_kota',
            [
            'id'          => $this->primaryKey()->unsigned(),
            'nomor'       => $this->string(32),
            'nama'        => $this->string(255)->notNull(),
            'singkatan'   => $this->string(64),
            'provinsi_id' => $this->integer(10)->unsigned(),
            'created_at'  => $this->integer(10)->unsigned(),
            'updated_at'  => $this->integer(10)->unsigned(),
            'created_by'  => $this->integer(10)->unsigned(),
            'updated_by'  => $this->integer(10)->unsigned(),
        ]);

        $this->createTable('drhidn_kecamatan',
            [
            'id'         => $this->primaryKey()->unsigned(),
            'nomor'      => $this->string(32),
            'nama'       => $this->string(255)->notNull(),
            'kota_id'    => $this->integer(10)->unsigned(),
            'created_at' => $this->integer(10)->unsigned(),
            'updated_at' => $this->integer(10)->unsigned(),
            'created_by' => $this->integer(10)->unsigned(),
            'updated_by' => $this->integer(10)->unsigned(),
        ]);

        $this->createTable('drhidn_kelurahan',
            [
            'id'           => $this->primaryKey()->unsigned(),
            'nomor'        => $this->string(32),
            'nama'         => $this->string(255)->notNull(),
            'kecamatan_id' => $this->integer(10)->unsigned(),
            'created_at'   => $this->integer(10)->unsigned(),
            'updated_at'   => $this->integer(10)->unsigned(),
            'created_by'   => $this->integer(10)->unsigned(),
            'updated_by'   => $this->integer(10)->unsigned(),
        ]);

        $this->createTable('drhidn_kodepos',
            [
            'id'           => $this->primaryKey()->unsigned(),
            'nomor'        => $this->integer(5)->unsigned(),
            'provinsi_id'  => $this->integer(10)->unsigned(),
            'kota_id'      => $this->integer(10)->unsigned(),
            'kecamatan_id' => $this->integer(10)->unsigned(),
            'kelurahan_id' => $this->integer(10)->unsigned(),
            'created_at'   => $this->integer(10)->unsigned(),
            'updated_at'   => $this->integer(10)->unsigned(),
            'created_by'   => $this->integer(10)->unsigned(),
            'updated_by'   => $this->integer(10)->unsigned(),
        ]);
    }

    public function down()
    {
        $this->dropTable('drhidn_kodepos');
        $this->dropTable('drhidn_kelurahan');
        $this->dropTable('drhidn_kecamatan');
        $this->dropTable('drhidn_kota');
        $this->dropTable('drhidn_provinsi');
    }

}