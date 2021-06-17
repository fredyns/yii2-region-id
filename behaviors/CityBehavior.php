<?php

namespace fredyns\region\behaviors;

use fredyns\region\models\City;
use yii\base\Event;
use yii\behaviors\AttributeBehavior;
use yii\db\BaseActiveRecord;

/**
 * new city name will be added automatically
 *
 * @property string $provinceAttribute
 * @property string $cityAttribute
 *
 * @author Fredy Nurman Saleh <email@fredyns.net>
 */
class CityBehavior extends AttributeBehavior
{
    public static $newIds = [];
    public $provinceAttribute = 'province_id';
    public $cityAttribute = 'city_id';
    public $value;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (empty($this->attributes)) {
            $this->attributes = [
                BaseActiveRecord::EVENT_BEFORE_INSERT => $this->cityAttribute,
                BaseActiveRecord::EVENT_BEFORE_UPDATE => $this->cityAttribute,
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
        $attribute = $this->cityAttribute;
        $value = $this->owner->{$attribute};

        $parentAttribute = $this->provinceAttribute;
        $parentId = $this->owner->{$parentAttribute};
        $parentValid = ($parentId > 0);

        if (is_numeric($value)) {
            return $value;
        } else if (empty($value) or $parentValid == FALSE) {
            return NULL;
        } else if (isset(static::$newIds[$value])) {
            return static::$newIds[$value];
        } else {
            $model = new City([
                'name' => $value,
                'province_id' => $parentId,
            ]);

            $model->save(FALSE);

            static::$newIds[$value] = $model->id;

            return $model->id;
        }
    }
}