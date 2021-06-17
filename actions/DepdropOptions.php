<?php

namespace fredyns\region\actions;

use Yii;
use yii\base\Action;
use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;
use yii\web\Response;

/**
 * Generic action to feed kartik depdrop
 *
 * @author Fredy Nurman Saleh <email@fredyns.net>
 */
class DepdropOptions extends Action
{
    public $modelClass;
    public $valueAttribute = 'id';
    public $labelAttribute = 'name';
    public $parentAttributes = [];
    public $queryFilter = null;
    public $attributeMapping;
    public $selectColumns;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        $requiredParams = ['modelClass', 'valueAttribute', 'labelAttribute', 'parentAttributes'];
        foreach ($requiredParams as $requiredParam) {
            if (empty($this->$requiredParam)) {
                throw new InvalidConfigException("Parameter {$requiredParam} must be defined.");
            }
        }

        if (!is_array($this->parentAttributes)) {
            throw new InvalidConfigException('Parents parameter must be an array.');
        }

        if (!class_exists($this->modelClass)) {
            throw new InvalidConfigException("Model class {$this->modelClass} is invalid.");
        }
    }

    public function run()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $selected = Yii::$app->request->get('selected', 0);
        $depdropParams = (array)Yii::$app->request->post('depdrop_parents', []);
        $parentConditions = $this->getParentConditions($depdropParams);
        if (empty($parentConditions)) {
            return [
                'output' => [],
                'selected' => $selected,
                'message' => "parent undefined.",
                'depdrop_parents' => $depdropParams,
            ];
        }

        $modelClass = $this->modelClass;
        $filter = $this->queryFilter;
        $attributeMapping = $this->attributeMapping ?: ['id' => $this->valueAttribute, 'name' => $this->labelAttribute];
        $selectColumns = $this->selectColumns ?: [$this->valueAttribute, $this->labelAttribute];

        /* @var $query ActiveQuery */
        $query = $modelClass::find();
        $query->select($selectColumns)->where($parentConditions);

        if ($filter instanceof \Closure) {
            $filter($query);
        } else if (is_array($filter)) {
            $query->andFilterWhere($filter);
        }

        $allRows = $query->all();
        $output = ArrayHelper::toArray($allRows, [$modelClass => $attributeMapping]);

        return ['output' => $output, 'selected' => $selected];
    }

    /**
     * Parse parent data conditions
     *
     * @param array $depdropParams
     * @return array
     */
    private function getParentConditions($depdropParams)
    {
        if (empty($depdropParams)) {
            return [];
        }

        $index = 0;
        $conditions = [];
        foreach ($this->parentAttributes as $attribute => $filter) {
            $value = trim($depdropParams[$index] ?? null);

            if (is_integer($attribute) && is_string($filter)) { // mentioning attribute name only
                $attribute = $filter;
            } else if (is_string($attribute) && $filter instanceof \Closure) { // mentioning attribute name & filtering function
                $value = $filter($value);
            }

            if (!empty($value)) {
                $conditions[$attribute] = $value;
            }

            $index++;
        }

        return $conditions;
    }
}