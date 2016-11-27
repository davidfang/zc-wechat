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
 * 前台设置微信对接URL路由规则：
 > 
 ```
 //wechat
         ['pattern'=>'wechat/<id:\d+>', 'route'=>'wechat'],
 ```
 >id为数据库微信ID
 


注意事项
---------
* for starter kit
* 使用`overtrue/wechat ` [参考文档](https://easywechat.org)


