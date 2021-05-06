<?php

namespace fredyns\daerahIndonesia\helpers;

use yii\helpers\ArrayHelper;

/**
 * generate option data for depdrop widget
 *
 * @author fredy
 */
class DepdropHelper
{

    /**
     * Generate Json data for depdrop option
     *
     * @param array $params
     * @return mixed
     */
    static function getOptionData($params = [])
    {
        $modelClass = $params['modelClass'];
        $parents = static::getParents($params['parents']);
        $selected = ArrayHelper::getValue($params, 'selected', 0);
        $idField = ArrayHelper::getValue($params, 'idField', 'id');
        $nameField = ArrayHelper::getValue($params, 'nameField', 'name');
        $filter = isset($params['filter']) ? $params['filter'] : NULL;
        $output = [];

        if (empty($parents) == FALSE) {
            $query = $modelClass::find();
            $query->where($parents);

            if ($filter instanceof \Closure) {
                $filter($query);
            } else if (is_array($filter)) {
                $query->andFilterWhere($filter);
            }

            $data = $query->all();
            $output = ArrayHelper::toArray($data, [$modelClass => ['id' => $idField, 'name' => $nameField]]);
        }

        return ['output' => $output, 'selected' => $selected];
    }

    /**
     * Parse parents data condition before generate options
     *
     * @param array $parents
     * @return array
     */
    static function getParents($parents = [])
    {
        $conditions = [];

        if (empty($parents) == FALSE && isset($_POST['depdrop_parents'])) {
            $parentIndex = 0;

            foreach ($parents as $field => $filter) {
                $value = trim(ArrayHelper::getValue($_POST['depdrop_parents'], $parentIndex, ""));

                if (is_integer($field) && is_string($filter)) {
                    $field = $filter;
                } else if (is_string($field) && $filter instanceof \Closure) {
                    $value = $filter($value);
                }

                if ($value !== "") {
                    $conditions[$field] = $value;
                }

                $parentIndex++;
            }
        }

        return $conditions;
    }
}