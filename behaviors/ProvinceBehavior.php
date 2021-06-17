<?php

namespace fredyns\region\behaviors;

use fredyns\region\models\Province;
use yii\base\Event;
use yii\behaviors\AttributeBehavior;
use yii\db\BaseActiveRecord;

/**
 * new province name will be added automatically
 *
 * @property string $provinceAttribute
 *
 * @author Fredy Nurman Saleh <email@fredyns.net>
 */
class ProvinceBehavior extends AttributeBehavior
{
    public static $newIds = [];
    public $provinceAttribute = 'province_id';
    public $value;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (empty($this->attributes)) {
            $this->attributes = [
                BaseActiveRecord::EVENT_BEFORE_INSERT => $this->provinceAttribute,
                BaseActiveRecord::EVENT_BEFORE_UPDATE => $this->provinceAttribute,
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
        $attribute = $this->provinceAttribute;
        $value = $this->owner->{$attribute};

        if (is_numeric($value)) {
            return $value;
        } else if (empty($value)) {
            return NULL;
        } else if (isset(static::$newIds[$value])) {
            return static::$newIds[$value];
        } else {
            $value = trim($value);
            $model = new Province([
                'name' => $value,
            ]);

            $model->save(FALSE);

            static::$newIds[$value] = $model->id;

            return $model->id;
        }
    }
}