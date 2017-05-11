<?php
namespace app\controllers;

use app\models\FinancialData;
use app\models\GrossProfitMargin;
use app\models\ThreeFees;
use yii;

class DoController extends BaseController {

    /**
     * 插入库表数据
     */
    public function actionAdd() {
        $FinancialDataModel = new FinancialData();
        $FinancialDataModel->loadData(Yii::$app->request->post(), '');
        $status = $FinancialDataModel->add();
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
    public function actionGrossProfitMargin() {
        $grossProfitMarginModel = new GrossProfitMargin();
        $result = $grossProfitMarginModel->getMargin();
        return '毛利率：' . $result;
    }

    /**
     * 三费占比
     */
    public function actionThreeFees() {
        $threeFeesModel = new ThreeFees();
        $threeFeesModel->loadData(Yii::$app->request->post(), '');
        $result = $threeFeesModel->getThreeFees();
        return '三费占比：' . $result;
    }
}