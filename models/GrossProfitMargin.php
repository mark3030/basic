<?php
namespace app\models;

use app\helpers\FormatterHelper;
use yii\base\Component;

class GrossProfitMargin extends Component {
    private $_profit;
    private $_cost;

    public function getMargin() {
        $data = FinancialData::getItems([], ['profit', 'cost']);
        $this->_profit = $data['profit'];
        $this->_cost = $data['cost'];
        $margin = (($this->_profit - $this->_cost)) / $this->_profit;
        $result = (new FormatterHelper())->asPercent($margin, 2);
        return $result;
    }

}