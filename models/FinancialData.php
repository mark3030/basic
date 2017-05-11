<?php
namespace app\models;

use yii\db\Exception;
use yii\db\Query;

class FinancialData extends BaseModel {
    public static function tableName() {
        return 'financial_data';
    }

    public function add() {
        $model = self::findOne(['code' => $this->code, 'date' => $this->date]);
        if ($model === null) {
            $model = $this;
        } else {
            $attributes = $this->attributes;
            unset($attributes['id']);
            foreach ($attributes as $name => $val) {
                $model->$name = $val;
            };
        }
        try {
            $model->save();
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return false;
    }

    public static function getItems($condition = [], $items = []) {
        $d = self::find()->filterWhere($condition)->asArray()->one();
        var_dump($d);exit;
        $query = new Query();
        $query->from(self::tableName())->filterWhere($condition);

        if (!empty($items)) {
            $query->select($items);
        }
        $rows = $query->limit(1)->one();
        $rows = parent::_result($rows);
        return $rows;
    }




}