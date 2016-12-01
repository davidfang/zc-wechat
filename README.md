zc wechat
=========
Yii2 wechat  for starter kit

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist zc/zc-wechat "*"
```

or add

```
"zc/zc-wechat": "*"
```

to the require section of your `composer.json` file.


Usage
-----

 *  前台
```
<?php
    ......
    'modules' => [
        'wechat' => [
            'class' => 'zc\wechat\front\Module',
        ],
    ],
    ......

```
微信请求URL:
 * 后台
 ```
 <?php
     ......
     'modules' => [
         'wechat' => [
             'class' => 'zc\wechat\admin\Module',
         ],
     ],
     ......
 
 ``` 
 * 后台设置微信对接信息 [http://backend.example.com/wechat/wechat]()
 * 微信公众后台设置请求URL为：http://fronted.example.com/wechat/{wechatId} `wechatId 管理后台wechat表ID`
 * 微信网页授权示例：
 > 网页授权采用的是session和get两种方式传递，经过授权后的页面可以通过`session['wechatUser']`或者`Yii::$app->request->get('wechatInfo')`
 方式判断是否授权，<font color=red>注意两种方式使用的参数不同<font>
 ```php
     $session = Yii::$app->session;
     $wechatInfo = Yii::$app->request->get('wechatInfo');
     // 未登录
     //if(! $session->has('wechatUser')){//session方式验证
     if($wechatInfo == null){//get方式验证
         $callback = \Yii::$app->request->get('callback',$_SERVER['REQUEST_URI']);//回跳地址
         Yii::$app->session->set('target_url',"/wechat/{$id}/{$scope}/test");
         $app = Wechat::getOauthApplication($id,$scope,"/wechat/{$id}/{$scope}/callback?callback=".urlencode($callback));
         $oauth = $app->oauth;
         $oauth->redirect()->send();
     }
     // 已经登录过
     $user = $session->get('wechatUser');
     echo 'Test1<br>';
     echo '<pre>';
     var_dump($user);($user);
     
     //other code .........
  ```
 >*  1. 直接访问页面自身 例：`http://fronted.example.com/wechat/1/snsapi_userinfo/test`
 >*  2. 访问PHP页面授权，跳转到静态页面 例：`http://fronted.example.com/wechat/1/snsapi_userinfo/test1`
 >*  3. 访问A页面授权完跳转到B页面 例：`http://fronted.example.com/wechat/1/snsapi_userinfo/test?callback=/wechat/auth/test2`
 >*  123可以查看AuthController中对应action示例
 * 前台设置微信对接URL路由规则：
 > 
 ```
 //wechat
         ['pattern'=>'wechat/<id:\d+>', 'route'=>'wechat'],//公众后台对接请求URL：/wechat/{wechatId}
         ['pattern'=>'wechat/<id:\d+>/<scope:(snsapi_base|snsapi_userinfo)>/<action:\w+>', 'route'=>'wechat/auth/<action>'],//网页授权路由
 ```
 >id为数据库微信ID
 


注意事项
---------
* for starter kit
* 使用`overtrue/wechat ` [参考文档](https://easywechat.org)


