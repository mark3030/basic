<?php
namespace app\helpers;

use yii\db\mysql\Schema;

class MysqlHelper extends Schema {
    public function _t() {
        $this->loadColumnSchema();
    }
}