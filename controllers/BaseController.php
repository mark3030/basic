<?php
namespace app\controllers;

use yii\web\Controller;
use yii\web\Response;
use yii;

class BaseController extends Controller {
    public function init() {
        parent::init();
        $this->enableCsrfValidation = false;
    }

    public function returnJson($ok = 0, $msg = '', $data = null) {
        $params = ['ok' => $ok, 'msg' => $msg, 'data' => $data];
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $params;
    }
}