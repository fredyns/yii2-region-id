<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace fredyns\daerahIndonesia\models\base;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base-model class for table "_kelurahan".
 *
 * @property integer $id
 * @property string $nomor
 * @property string $nama
 * @property integer $kecamatan_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property \fredyns\daerahIndonesia\models\Kecamatan $kecamatan
 * @property \fredyns\daerahIndonesia\models\Kodepos[] $kodepos
 * @property string $aliasModel
 */
abstract class Kelurahan extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'drhidn_kelurahan';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::className(),
            ],
            [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['kecamatan_id'], 'integer'],
            [['nomor'], 'string', 'max' => 32],
            [['nama'], 'string', 'max' => 255],
            [['kecamatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kecamatan::className(), 'targetAttribute' => ['kecamatan_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'           => 'ID',
            'created_at'   => 'Created At',
            'updated_at'   => 'Updated At',
            'created_by'   => 'Created By',
            'updated_by'   => 'Updated By',
            'nomor'        => 'Nomor',
            'nama'         => 'Nama',
            'kecamatan_id' => 'Kecamatan ID',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return array_merge(parent::attributeHints(),
            [
            'id'         => 'id entry',
            'created_at' => 'waktu insert',
            'updated_at' => 'waktu update terakhir',
            'created_by' => 'id user yg melakukan insert terakhir',
            'updated_by' => 'id user yg melakukan update terakhir',
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKecamatan()
    {
        return $this->hasOne(\fredyns\daerahIndonesia\models\Kecamatan::className(), ['id' => 'kecamatan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKodepos()
    {
        return $this->hasMany(\fredyns\daerahIndonesia\models\Kodepos::className(), ['kelurahan_id' => 'id']);
    }

}