<?php
namespace app\models;

use app\helpers\FormatterHelper;
use yii\db\ActiveRecord;

class BaseModel extends ActiveRecord {


    public function getFormatter() {
        return new FormatterHelper();
    }

    public function loadData($data, $modelName = null) {
        if ($modelName === null) {
            //如果没有指定模型名字
            $reflector = new \ReflectionClass($this);
            //得到短类名，比如类名是 app\models\UserForm 那就是得到 UserForm 这一部分
            $modelName = $reflector->getShortName();
        }

        if ($modelName === '') {
            //如果指定了为空字符串，直接把key当属性名赋值value套到自己的属性里
            foreach ($data as $key => $value) {
                if (strpos($value, ',')) {
                    $value = $this->getFormatter()->currencyToFloat($value);
                }
                $this->{$key} = $value;
            }
            return true;

        } elseif (isset($data[$modelName])) {
            //如果模型名字比如 UserForm 这个key在data里的话，那就遍历这个key下面的属性进行赋值
            foreach ($data[$modelName] as $key => $value) {
                $this->{$key} = $this->getFormatter()->currencyToFloat($value);
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * 把数据库中的字符串转换为数据库字段，但仅限
     */
    protected static function _result(array $rows = []) {
        if (empty($rows)) {
            return $rows;
        }
        $columns = static::getTableSchema()->columns;
        foreach ($rows as $name => $value) {
            if (isset($columns[$name])) {
                $rows[$name] = $columns[$name]->phpTypecast($value);
            }
        }
        return $rows;
    }
}