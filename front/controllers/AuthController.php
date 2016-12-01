<?php

namespace zc\wechat\front\controllers;

use Yii;
use yii\base\ErrorException;
use yii\web\Controller;
use zc\wechat\models\Wechat;

/**
 * Default controller for the `front` module
 */
class AuthController extends Controller
{

    /**
     * 授权回调页面
     * @param $id
     * @param $scope Scopes: snsapi_base 与 snsapi_userinfo
     */
    public function actionCallback($id,$scope)
    {
        $app = Wechat::getOauthApplication($id,$scope,"/wechat/{$id}/{$scope}/callback");
        $oauth = $app->oauth;

        // 获取 OAuth 授权结果用户信息
        $user = $oauth->user();
        Yii::$app->session->set('wechat_user',$user->toArray());

        $targetUrl = Yii::$app->request->get('callback','/');
        Yii::$app->response->redirect($targetUrl);
    }

    /**
     * @param $id
     * @param $scope
     */
    public function actionTest($id,$scope){
        $session = Yii::$app->session;
        // 未登录
        if(! $session->has('wechat_user')){
            $callback = \Yii::$app->request->get('callback',$_SERVER['REQUEST_URI']);//回跳地址
            Yii::$app->session->set('target_url',"/wechat/{$id}/{$scope}/test");
            $app = Wechat::getOauthApplication($id,$scope,"/wechat/{$id}/{$scope}/callback?callback=".urlencode($callback));
            $oauth = $app->oauth;
            $oauth->redirect()->send();
        }
        // 已经登录过
        $user = $session->get('wechat_user');
        echo 'Test1<br>';
        echo '<pre>';
        var_dump($user);
    }
    public function actionTest2(){
        $session = Yii::$app->session;
        $user = $session->get('wechat_user');
        echo 'test2<br>';
        echo '<pre>';
        var_dump($user);
    }
}
