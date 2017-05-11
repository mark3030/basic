<?php
namespace app\models;
class ThreeFees extends BaseModel {
    public $financial_fee;//财务费用
    public $manage_fee;//管理费用
    public $sale_fee;//销售费用


    public function getThreeFees() {
        $fees = ($this->financial_fee + $this->manage_fee + $this->sale_fee) / $this->profit;
        $result = $this->getFormatter()->asPercent($fees, 2);
        return $result;
    }
}