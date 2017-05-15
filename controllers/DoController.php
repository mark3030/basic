<?php
namespace app\controllers;

use app\models\GrossProfitMargin;
use app\models\Profit;
use app\models\ThreeFees;
use yii;

class DoController extends BaseController {

    /**
     * 插入库表数据（dev）
     */
    public function actionAdd() {
        $profitModel = new Profit();
        $profitModel->loadData(Yii::$app->request->post(), '');
        $status = $profitModel->add();
        if ($status) {
            $result = '插入成功';
        } else {
            $result = '插入失败';
        }
        return $result;
    }

    /*
     * 毛利率
     */
    public function actionGetGrossProfitMargin() {
        $profitModel = new Profit();
        $result = $profitModel->grossProfitMargin();
        return '毛利率：' . $result;
    }

    /**
     * 三费占比
     */
    public function actionGetThreeFees() {
        $profitModel = new Profit();
        $result = $profitModel->threeFees();
        return '三费占比：' . $result;
    }
}