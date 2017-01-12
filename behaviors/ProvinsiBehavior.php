<?php

namespace fredyns\daerahIndonesia\behaviors;

use Yii;
use yii\base\Event;
use yii\behaviors\AttributeBehavior;
use yii\db\BaseActiveRecord;
use fredyns\daerahIndonesia\models\Provinsi;

/**
 * menangani atribut provinsi
 * ketika mengetikan nama baru akan ditambahkan ke dalam database
 * 
 * @property string $provinsiAttribute nama atribut/kolom provinsi
 *
 * @author fredy
 */
class ProvinsiBehavior extends AttributeBehavior
{
    public $provinsiAttribute = 'provinsi_id';
    public $value;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (empty($this->attributes)) {
            $this->attributes = [
                BaseActiveRecord::EVENT_BEFORE_INSERT => $this->provinsiAttribute,
                BaseActiveRecord::EVENT_BEFORE_UPDATE => $this->provinsiAttribute,
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
        $attribute = $this->provinsiAttribute;
        $value = $this->owner->$attribute;

        if (is_numeric($value)) {
            return $value;
        } else if (empty($value)) {
            return NULL;
        } else {
            $model = new Provinsi([
                'nama' => $value,
            ]);

            $model->save(FALSE);

            return $model->id;
        }
    }
}