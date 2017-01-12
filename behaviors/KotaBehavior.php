<?php

namespace fredyns\daerahIndonesia\behaviors;

use Yii;
use yii\base\Event;
use yii\behaviors\AttributeBehavior;
use yii\db\BaseActiveRecord;
use fredyns\daerahIndonesia\models\Kota;

/**
 * menangani atribut kota
 * ketika mengetikan nama baru akan ditambahkan ke dalam database
 *
 * @property string $provinsiAttribute nama atribut/kolom provinsi
 * @property string $kotaAttribute nama atribut/kolom kota
 *
 * @author fredy
 */
class KotaBehavior extends AttributeBehavior
{
    public $provinsiAttribute = 'provinsi_id';
    public $kotaAttribute = 'kota_id';
    public $value;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (empty($this->attributes)) {
            $this->attributes = [
                BaseActiveRecord::EVENT_BEFORE_INSERT => $this->kotaAttribute,
                BaseActiveRecord::EVENT_BEFORE_UPDATE => $this->kotaAttribute,
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
        $attribute = $this->kotaAttribute;
        $value = $this->owner->$attribute;

        $parentAttribute = $this->provinsiAttribute;
        $parent_id = $this->owner->$parentAttribute;
        $parent_valid = ($parent_id > 0);

        if (is_numeric($value)) {
            return $value;
        } else if (empty($value) OR $parent_valid == FALSE) {
            return NULL;
        } else {
            $model = new Kota([
                'nama' => $value,
                'provinsi_id' => $parent_id,
            ]);

            $model->save(FALSE);

            return $model->id;
        }
    }
}