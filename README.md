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
 > 网页授权采用的是session方式传递，经过授权后的页面可以通过session方式判断是否授权
 ```php
 $session = Yii::$app->session;
         // 未授权
         if(! $session->has('wechat_user')){
             $callback = \Yii::$app->request->get('callback',$_SERVER['REQUEST_URI']);//回跳地址
             Yii::$app->session->set('target_url',"/wechat/{$id}/{$scope}/test");
             $app = Wechat::getOauthApplication($id,$scope,"/wechat/{$id}/{$scope}/callback?callback=".urlencode($callback));
             $oauth = $app->oauth;
             $oauth->redirect()->send();
         }
         // 已经授权过
         $user = $session->get('wechat_user');
         var_dump($user);
         
         //other code .........
  ```
 >*  1. 直接访问页面自身 例：`http://fronted.example.com/wechat/1/snsapi_userinfo/test`
 >*  2. 访问A页面授权完跳转到B页面 例：`http://fronted.example.com/wechat/1/snsapi_userinfo/test?callback=/wechat/auth/test2`
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


