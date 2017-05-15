<?php
namespace app\models;

use app\helpers\FormatterHelper;

Trait ProfitTrait {
    public $profit;//营业收入
    public $cost;//营业成本
    public $financial_fee;//财务费用
    public $manage_fee;//管理费用
    public $sale_fee;//销售费用

    /**
     * 毛利率：（营业收入-营业成本）/营业收入
     */
    public function grossProfitMargin() {
        $data = Profit::getItems([], ['profit', 'cost']);
        $this->profit = $data['profit'];
        $this->cost = $data['cost'];
        $margin = (($this->profit - $this->cost)) / $this->profit;
        $result = (new FormatterHelper())->asPercent($margin, 2);
        return $result;
    }

    /**
     * 三费占比：（销售费用+管理费用+财务费用）/营业收入。
     */
    public function threeFees() {
        $data = Profit::getItems([], ['profit', 'financial_fee','manage_fee','sale_fee']);
        $this->profit = $data['profit'];
        $this->financial_fee = $data['financial_fee'];
        $this->manage_fee = $data['manage_fee'];
        $this->sale_fee = $data['sale_fee'];
        $margin = (($this->financial_fee + $this->manage_fee + $this->sale_fee)) / $this->profit;
        $result = (new FormatterHelper())->asPercent($margin, 2);
        return $result;
    }
}