<?php

namespace fredyns\daerahIndonesia\behaviors;

use Yii;
use yii\base\Event;
use yii\behaviors\AttributeBehavior;
use yii\db\BaseActiveRecord;
use fredyns\daerahIndonesia\models\Kelurahan;

/**
 * menangani atribut Kelurahan
 * ketika mengetikan nama baru akan ditambahkan ke dalam database
 *
 * @property string $kecamatanAttribute nama atribut/kolom kecamatan
 * @property string $kelurahanAttribute nama atribut/kolom kelurahan
 *
 * @author fredy
 */
class KelurahanBehavior extends AttributeBehavior
{
    public $kecamatanAttribute = 'kecamatan_id';
    public $kelurahanAttribute = 'kelurahan_id';
    public $value;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (empty($this->attributes)) {
            $this->attributes = [
                BaseActiveRecord::EVENT_BEFORE_INSERT => $this->kelurahanAttribute,
                BaseActiveRecord::EVENT_BEFORE_UPDATE => $this->kelurahanAttribute,
            ];
        }
    }

    /**
     * Evaluates the value of the user.
     * The return result of this method will be assigned to the current attribute(s).
     * @param Event $event
     * @return mixed the value of the user.
     */
    protected function getValue($event)
    {
        $attribute = $this->kelurahanAttribute;
        $value = $this->owner->$attribute;

        $parentAttribute = $this->kecamatanAttribute;
        $parent_id = $this->owner->$parentAttribute;
        $parent_valid = ($parent_id > 0);

        if (is_numeric($value)) {
            return $value;
        } else if (empty($value) OR $parent_valid == FALSE) {
            return NULL;
        } else {
            $model = new Kelurahan([
                'nama' => $value,
                'kecamatan_id' => $parent_id,
            ]);

            $model->save(FALSE);

            return $model->id;
        }
    }
}