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
        Yii::$app->session->set('wechatUser_'.$scope,$user->toArray());

        $targetUrl = Yii::$app->request->get('callback','/');
        if (strpos($targetUrl, '?') === false) {
            $targetUrl .= '?wechatInfo=' . urlencode(json_encode($user->toArray()));
        } else {
            $targetUrl .= '&wechatInfo=' . urlencode(json_encode($user->toArray()));
        }
        Yii::$app->response->redirect($targetUrl);
    }

    /**
     * 基本授权调用示例
     *   1. 直接访问页面自身 例：`http://fronted.example.com/wechat/1/snsapi_userinfo/test`
     *  2. 访问A页面授权完跳转到B页面 例：`http://fronted.example.com/wechat/1/snsapi_userinfo/test?callback=/wechat/auth/test2`
     *  可以验证会话模式为：session和get,get时每次都去微信服务器授权
     * @param $id
     * @param $scope
     */
    public function actionPhp($id,$scope){
        $session = Yii::$app->session;
        $wechatInfo = Yii::$app->request->get('wechatInfo');
        // 未登录
        //if(! $session->has('wechatUser_'.$scope)){//session方式验证
        if($wechatInfo == null){//get方式验证
            $callback = \Yii::$app->request->get('callback',$_SERVER['REQUEST_URI']);//回跳地址
            Yii::$app->session->set('target_url',"/wechat/{$id}/{$scope}/php");
            $app = Wechat::getOauthApplication($id,$scope,"/wechat/{$id}/{$scope}/callback?callback=".urlencode($callback));
            $oauth = $app->oauth;
            $oauth->redirect()->send();
        }
        // 已经登录过
        $user = $session->get('wechatUser_'.$scope);
        echo 'actionTest var_dump<br>';
        echo '<pre>';
        var_dump($user);
        echo '--------------------<br>';
        var_dump($wechatInfo);
    }
    /**
     * 为静态页面授权获得微信信息，信息存储到localStorage.setItem('wechatInfo')
     * @param $id
     * @param $scope
     */
    public function actionJs($id,$scope){
        $session = Yii::$app->session;
        $wechatInfo = Yii::$app->request->get('wechatInfo');
        // 未登录
        //if(! $session->has('wechatUser_'.$scope)){
        if($wechatInfo == null){
            $callback = \Yii::$app->request->get('callback',$_SERVER['REQUEST_URI']);//回跳地址
            Yii::$app->session->set('target_url',"/wechat/{$id}/{$scope}/js");
            $app = Wechat::getOauthApplication($id,$scope,"/wechat/{$id}/{$scope}/callback?callback=".urlencode($callback));
            $oauth = $app->oauth;
            $oauth->redirect()->send();
        }
        // 已经登录过
        $user = $session->get('wechatUser_'.$scope);
        echo 'actionTest1 var_dump <br>';
        echo '<pre>';
        var_dump($user);
        echo '--------------------<br>';
        var_dump($wechatInfo);
        echo  <<<doc
<script type="application/javascript">
        var openId = localStorage.setItem('openId','$wechatInfo');
        //document.getElementById("openId").innerHTML = openId;
        location.href = "/index.html";//JS跳转到静态页面的地址
    </script>
doc;
    }

    /**
     * 在test页面授权后跳转到test2页面
     */
    public function actionTest2(){
        $session = Yii::$app->session;
        $user = $session->get('wechatUser_snsapi_userinfo');
        echo 'action test2 var_dump<br>';
        echo '<pre>';
        var_dump($user);
    }
}
