<?php

namespace fredyns\region\behaviors;

use fredyns\region\models\Subdistrict;
use yii\base\Event;
use yii\behaviors\AttributeBehavior;
use yii\db\BaseActiveRecord;

/**
 * new subdistrict name will be added automatically
 *
 * @property string $districtAttribute
 * @property string $subdistrictAttribute
 *
 * @author Fredy Nurman Saleh <email@fredyns.net>
 */
class SubdistrictBehavior extends AttributeBehavior
{
    public static $newIds = [];
    public $districtAttribute = 'district_id';
    public $subdistrictAttribute = 'subdistrict_id';
    public $value;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (empty($this->attributes)) {
            $this->attributes = [
                BaseActiveRecord::EVENT_BEFORE_INSERT => $this->subdistrictAttribute,
                BaseActiveRecord::EVENT_BEFORE_UPDATE => $this->subdistrictAttribute,
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
        $attribute = $this->subdistrictAttribute;
        $value = $this->owner->$attribute;

        $parentAttribute = $this->districtAttribute;
        $parentId = $this->owner->$parentAttribute;
        $parentValid = ($parentId > 0);

        if (is_numeric($value)) {
            return $value;
        } else if (empty($value) or $parentValid == FALSE) {
            return NULL;
        } else if (isset(static::$newIds[$value])) {
            return static::$newIds[$value];
        } else {
            $model = new Subdistrict([
                'name' => $value,
                'district_id' => $parentId,
            ]);

            $model->save(FALSE);

            static::$newIds[$value] = $model->id;

            return $model->id;
        }
    }
}