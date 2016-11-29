<?php

namespace zc\wechat\front\controllers;

use Yii;
use EasyWeChat\Message\Image;
use EasyWeChat\Message\News;
use EasyWeChat\Message\Text;
use EasyWeChat\Message\Video;
use EasyWeChat\Message\Voice;
use yii\base\ErrorException;
use yii\rest\Controller;
use zc\wechat\models\Wechat;

/**
 * Default controller for the `front` module
 */
class DefaultController extends Controller
{
    public $wechatId;//请求微信ID
    /**
     * Renders the index view for the module
     * @param $id
     * @return string
     */
    public function actionIndex($id)
    {
        $this->wechatId = $id;


        $app = Wechat::getApplication($id);

        // 从项目实例中得到服务端应用实例。
        $server = $app->server;
        /*$server->setMessageHandler(function ($message) {
            // $message->FromUserName // 用户的 openid
            // $message->MsgType // 消息类型：event, text....
            return "您好！欢迎欢迎关注我!";
        });*/

        $server->setMessageHandler(function ($message) {
            $request = [
                'ToUserName' => $message->ToUserName ,//   接收方帐号（该公众号 ID）
                'FromUserName' => $message->FromUserName ,// 发送方帐号（OpenID, 代表用户的唯一标识）
                'CreateTime' => $message->CreateTime ,//   消息创建时间（时间戳）
                'MsgId' => $message->MsgId ,//        消息 ID（64位整型）
            ];

            switch ($message->MsgType) {
                case 'event':
                    # 事件消息...
                    $return = "事件消息--";
                    switch (strtolower($message->Event)){
//关注
                        case 'subscribe':
                            //$return .= "欢迎关注...";
                            //二维码关注
                            if(isset($message->eventkey) && isset($message->ticket)){
                                $request['EventKey'] = $message->EventKey;//  event    消息类型
                                $request['Ticket'] = $message->Ticket;//    subscribe    关注
                                //$return .= "二维码关注...";
                                $return .= "扫码首访欢迎语";
                            }else{//普通关注

                                //$return .= "普通关注...";
                                $return .= "关注首访欢迎语";
                            }
                             //普通关注
                               // $return .= '普通关注';
                            //关注
                            $write_log_model = new \zc\wechat\models\EventSubscribe();

                            $request['MsgType'] = $message->MsgType;//  event    消息类型
                            $request['Event'] = $message->Event;//    subscribe    关注

                            break;

                            /*$write_log_model = new \ZhiCaiWX\models\EventSubscribe();

                            $check_user_info = models\User::findOne($request['fromusername']);//在用户表中检查是否已经有用户信息
                            if(empty($check_user_info)){//不存在的用户，新用户全新写入
                                //记录用户基本信息
                                $user_info = UserManage::getUserInfo($request['fromusername']);
                                $_model_user = new models\User();
                                foreach ($user_info as $key=>$value) {
                                    $_model_user->$key = $value;
                                }
                            }else{//新用户更新信息
                                $_model_user =  $check_user_info;
                                $_model_user->subscribe =1;
                                $_model_user->subscribe_time =time();
                            }

                            $_model_user->save();*/
                            break;
                        //取消关注
                        case 'unsubscribe':
                            //$return .= "取消关注...";
                            $return .= "取消关注";
                            //更新用户为未关注
                            $write_log_model = new \zc\wechat\models\EventSubscribe();

                            $request['MsgType'] = $message->MsgType;//  event    消息类型
                            $request['Event'] = $message->Event;//    unsubscribe    取消关注

//                            $user = models\User::findOne(['openid'=>$request['fromusername']]);
//                            $user->subscribe = 0;
//                            $user->save();
                            break;
                        //扫描二维码
                        case 'scan':
                            //$return .= "欢迎关注...";
                            //二维码关注
                            //$return .= '二维码关注';
                            $return .= '扫码已关注欢迎语';

                            //关注
                            $write_log_model = new \zc\wechat\models\EventScan();

                            $request['MsgType'] = $message->MsgType;//  event    消息类型
                            $request['Event'] = $message->Event;//    SCAN    关注
                            $request['Eventkey'] = $message->Eventkey;//事件KEY值，是一个32位无符号整数，即创建二维码时的二维码scene_id
                            $request['Ticket'] = $message->Ticket;//二维码的ticket，可用来换取二维码图片

                            break;
                        //地理位置
                        case 'location':
                            //$return .= "地理位置...";
                            $return .= "地理位置";
                            $write_log_model = new \zc\wechat\models\EventLocation();

                            # 上报地理位置事件
                            $request['MsgType'] = $message->MsgType;//  event    消息类型
                            $request['Event'] = $message->Event;//    location    地理位置
                            $request['Latitude'] = $message->Latitude;//      23.137466   地理位置纬度
                            $request['Longitude'] = $message->Longitude;//     113.352425  地理位置经度
                            $request['Precision'] = $message->Precision;//     119.385040  地理位置精度
                            break;
                        //自定义菜单 - 点击菜单拉取消息时的事件推送
                        case 'click':
                            //$return .= "点击菜单拉取消息...";
                            $return .= "菜单--拉取消息";
                            $write_log_model = new \zc\wechat\models\EventMenu();

                            #自定义菜单 - 点击菜单拉取消息时的事件推送
                            $request['MsgType'] = $message->MsgType;//  event    消息类型
                            $request['Event'] = $message->Event;//    click    点击菜单
                            $request['EventKey'] = $message->EventKey;//    事件KEY值，与自定义菜单接口中KEY值对应

                            break;
                        //自定义菜单 - 点击菜单跳转链接时的事件推送
                        case 'view':
                            //$return .= "点击菜单跳转链接...";
                            $return .= "菜单--跳转链接";
                            $write_log_model = new \zc\wechat\models\EventMenu();

                            #自定义菜单 - 点击菜单跳转链接时的事件推送
                            $request['MsgType'] = $message->MsgType;//  event    消息类型
                            $request['Event'] = $message->Event;//    view    点击菜单
                            $request['EventKey'] = $message->EventKey;//    事件KEY值，设置的跳转URL
                            $request['MenuID'] = $message->MenuID;//    指菜单ID，如果是个性化菜单，则可以通过这个字段，知道是哪个规则的菜单被点击了。

                            break;
                        //自定义菜单 - 扫码推事件的事件推送
                        case 'scancode_push':
                            //$return .= "点击菜单扫码推事件的事件推送...";
                            $return .= "菜单--扫码推事件";
                            $write_log_model = new \zc\wechat\models\EventMenu();

                            #自定义菜单 - 扫码推事件的事件推送
                            $request['MsgType'] = $message->MsgType;//  event    消息类型
                            $request['Event'] = $message->Event;//    scancode_push    事件类型
                            $request['EventKey'] = $message->EventKey;//    EventKey	事件KEY值，由开发者在创建菜单时设定

                            $request['ScanCodeInfo'] = $message->ScanCodeInfo;//    	扫描信息
                            $request['ScanType'] = $message->ScanType;//    	扫描类型，一般是qrcode
                            $request['ScanResult'] = $message->ScanResult;//    	扫描结果，即二维码对应的字符串信息



                            break;
                        //自定义菜单 - 扫码推事件且弹出“消息接收中”提示框的事件推送
                        case 'scancode_waitmsg':
                            //$return .= "点击菜单扫码推事件的事件推送...";
                            $return .= "菜单--扫码推事件";
                            $write_log_model = new \zc\wechat\models\EventMenu();

                            #自定义菜单 - 扫码推事件且弹出“消息接收中”提示框的事件推送
                            $request['MsgType'] = $message->MsgType;//  event    消息类型
                            $request['Event'] = $message->Event;//    scancode_waitmsg    事件类型
                            $request['EventKey'] = $message->EventKey;//    EventKey	事件KEY值，由开发者在创建菜单时设定

                            $request['ScanCodeInfo'] = $message->ScanCodeInfo;//    	扫描信息
                            $request['ScanType'] = $message->ScanType;//    	扫描类型，一般是qrcode
                            $request['ScanResult'] = $message->ScanResult;//    	扫描结果，即二维码对应的字符串信息

                            break;
                        //自定义菜单 - 弹出系统拍照发图的事件推送
                        case 'pic_sysphoto':
                            //$return .= "点击菜单弹出系统拍照发图的事件推送...";
                            $return .= "菜单--系统拍照发图";
                            $write_log_model = new \zc\wechat\models\EventMenu();

                            #自定义菜单 - 弹出系统拍照发图的事件推送
                            $request['MsgType'] = $message->MsgType;//  event    消息类型
                            $request['Event'] = $message->Event;//    pic_sysphoto    事件类型
                            $request['EventKey'] = $message->EventKey;//    EventKey	事件KEY值，由开发者在创建菜单时设定

                            $request['SendPicsInfo'] = $message->SendPicsInfo;//    	发送的图片信息
                            $request['Count'] = $message->Count;//    	发送的图片数量
                            $request['PicList'] = $message->PicList;//    	图片列表
                            $request['PicMd5Sum'] = $message->PicMd5Sum;//    	图片的MD5值，开发者若需要，可用于验证接收到图片


                            break;
                        //自定义菜单 - 弹出拍照或者相册发图的事件推送
                        case 'pic_photo_or_album':
                            //$return .= "点击菜单弹出拍照或者相册发图的事件推送...";
                            $return .= "菜单--拍照或者相册发图";
                            $write_log_model = new \zc\wechat\models\EventMenu();

                            #自定义菜单 - 弹出拍照或者相册发图的事件推送
                            $request['MsgType'] = $message->MsgType;//  event    消息类型
                            $request['Event'] = $message->Event;//    pic_photo_or_album    事件类型
                            $request['EventKey'] = $message->EventKey;//    EventKey	事件KEY值，由开发者在创建菜单时设定

                            $request['SendPicsInfo'] = $message->SendPicsInfo;//    	发送的图片信息
                            $request['Count'] = $message->Count;//    	发送的图片数量
                            $request['PicList'] = $message->PicList;//    	图片列表
                            $request['PicMd5Sum'] = $message->PicMd5Sum;//    	图片的MD5值，开发者若需要，可用于验证接收到图片


                            break;
                        //自定义菜单 - 弹出微信相册发图器的事件推送
                        case 'pic_weixin':
                            //$return .= "点击菜单弹出微信相册发图器的事件推送...";
                            $return .= "菜单--微信相册发图器";
                            $write_log_model = new \zc\wechat\models\EventMenu();

                            #自定义菜单 - 弹出微信相册发图器的事件推送
                            $request['MsgType'] = $message->MsgType;//  event    消息类型
                            $request['Event'] = $message->Event;//    pic_weixin    事件类型
                            $request['EventKey'] = $message->EventKey;//    EventKey	事件KEY值，由开发者在创建菜单时设定

                            $request['SendPicsInfo'] = $message->SendPicsInfo;//    	发送的图片信息
                            $request['Count'] = $message->Count;//    	发送的图片数量
                            $request['PicList'] = $message->PicList;//    	图片列表
                            $request['PicMd5Sum'] = $message->PicMd5Sum;//    	图片的MD5值，开发者若需要，可用于验证接收到图片


                            break;
                        //自定义菜单 - 弹出地理位置选择器的事件推送
                        case 'location_select':
                            //$return .= "点击菜单弹出地理位置选择器的事件推送...";
                            $return .= "菜单--地理位置选择器";
                            $write_log_model = new \zc\wechat\models\EventMenu();

                            #自定义菜单 - 弹出地理位置选择器的事件推送
                            $request['MsgType'] = $message->MsgType;//  event    消息类型
                            $request['Event'] = $message->Event;//    location_select    事件类型
                            $request['EventKey'] = $message->EventKey;//    EventKey	事件KEY值，由开发者在创建菜单时设定

                            $request['SendPicsInfo'] = $message->SendPicsInfo;//    	发送的图片信息
                            $request['Count'] = $message->Count;//    	发送的图片数量
                            $request['PicList'] = $message->PicList;//    	图片列表
                            $request['PicMd5Sum'] = $message->PicMd5Sum;//    	图片的MD5值，开发者若需要，可用于验证接收到图片

                            $request['SendLocationInfo'] = $message->SendLocationInfo;//	发送的位置信息
                            $request['Location_X'] = $message->Location_X;//	X坐标信息
                            $request['Location_Y'] = $message->Location_Y;//	Y坐标信息
                            $request['Scale'] = $message->Scale;//	精度，可理解为精度或者比例尺、越精细的话 scale越高
                            $request['Label'] = $message->Label;//	地理位置的字符串信息
                            $request['Poiname'] = $message->Poiname	;//朋友圈POI的名字，可能为空
                            break;
                        //群发接口完成后推送的结果
                        case 'masssendjobfinish':
                            //$return .= "群发接口完成后推送的结果...\n";
                            $return .= "群发接口完成";
                            //此处未完成
                            break;
                        //模板消息完成后推送的结果
                        case 'templatesendjobfinish':
                            //$return .= "模板消息完成后推送的结果...\n";
                            $return .= "模板消息完成";
                            break;
                        default:
                            $return .='---$message->Event--'. $message->Event;
                            //return Msg::returnErrMsg(MsgConstant::ERROR_UNKNOW_TYPE, '收到了未知类型的消息', $request);
                            break;
                    }
                    break;
                case 'text':
                    # 文字消息...
                    //$return = "文字消息...";
                    $return = $message->Content;
                    $write_log_model = new \zc\wechat\models\RequestText();
                    $request['MsgType'] = $message->MsgType;//  text
                    $request['Content'] = $message->Content;//  文本消息内容
                    break;
                case 'image':
                    # 图片消息...
                    //$return = "图片消息...";
                    $return = "收到图片";
                    $write_log_model = new \zc\wechat\models\RequestImage();
                    $request['MsgType'] = $message->MsgType;//  image
                    $request['MediaId'] = $message->MediaId;// 图片消息媒体id，可以调用多媒体文件下载接口拉取数据。
                    $request['PicUrl'] = $message->PicUrl;//   图片链接
                    break;
                case 'voice':
                    # 语音消息...
                    //$return = "语音消息...";
                    if(!isset($message->Recognition)){
                        $return = '收到语音';

                    }else{
                        $return = '收到语音：'.$message->Recognition;

                    }
                    $write_log_model = new \zc\wechat\models\RequestVoice();

                    $request['MsgType'] = $message->MsgType;//        voice
                    $request['MediaId'] = $message->MediaId;//        语音消息媒体id，可以调用多媒体文件下载接口拉取数据。
                    $request['Format'] = $message->Format;//         语音格式，如 amr，speex 等
                    $request['Recognition'] = $message->Recognition;// * 开通语音识别后才有

                    break;
                case 'video':
                case 'shortvideo':
                    # 视频消息...
                    # 小视频...
                    //$return = "视频消息..." .$message->MsgType;
                    $return = "收到视频" .$message->MsgType;
                    $write_log_model = new \zc\wechat\models\RequestVideo();

                    $request['MsgType'] = $message->MsgType;//        video  / shortvideo
                    $request['MediaId'] = $message->MediaId;//       视频消息媒体id，可以调用多媒体文件下载接口拉取数据。
                    $request['ThumbMediaId'] = $message->ThumbMediaId;//  视频消息缩略图的媒体id，可以调用多媒体文件下载接口拉取数据。
                    break;
                case 'location':
                    # 坐标消息...
                    //$return = "坐标消息...";
                    $return = "收到主动上报地理位置";
                    $write_log_model = new \zc\wechat\models\RequestLocation();
                    $request['MsgType'] = $message->MsgType;//      location
                    $request['Location_X'] = $message->Location_X;//   地理位置纬度
                    $request['Location_Y'] = $message->Location_Y;//   地理位置经度
                    $request['Scale'] = $message->Scale;//        地图缩放大小
                    $request['Label'] = $message->Label;//        地理位置信息
                    break;
                case 'link':
                    $return = "链接消息...";
                    # 链接消息...
                    //$return = "链接消息...";
                    $return = "收到链接";
                    $write_log_model = new \zc\wechat\models\RequestLink();
                    $request['MsgType'] = $message->MsgType;//      link

                    $request['Title'] = $message->Title;//        消息标题
                    $request['Description'] = $message->Description;//  消息描述
                    $request['Url'] = $message->Url;//          消息链接

                    break;
                // ... 其它消息
                default:
                    # code...
                    //$return = "code...";
                    $return = "默认回复";
                    break;
            }
            // ...
            //记录请求日志
            if(isset($write_log_model)) {
                try {
                    $write_log_model->load($request, '');
                    $write_log_model->save();//保存日志
                    if ($write_log_model->hasErrors()) {
                        $t = '数据存储错误：';
                        /*foreach ($write_log_model->getErrors() as $k => $item) {
                            $t .= $k . $item;
                        };*/
                        $t .= json_encode($write_log_model->getErrors(), JSON_UNESCAPED_UNICODE);
                        return $t;
                    }
                } catch (ErrorException $errorException) {
                    return '程序错误' . $errorException->getMessage();//$errorException->getTraceAsString();
                }
            }

            //return $return;
            return self::answer($return,$message);
        });




        $response = $server->serve();
        return $response->send(); // Laravel 里请使用：return $response;

        return $this->render('index',['id'=>$id]);
    }

    /**
     * @description 根据关键词，查询返回的信息
     * @param $keyword 关键词
     * @param $request 原始请求信息&$request,
     * @return string
     */
    public function answer($keyword,$message){
        $response_keyword = \zc\wechat\models\ResponseKeyword::findOne(['keyword'=>$keyword]);
        if(empty($response_keyword)){//没有找到关键词
            $request_keyword = \zc\wechat\models\RequestKeyword::findOne(['keyword'=>$keyword]);
            if(empty($request_keyword)){//没有则新建记录
                $request_keyword = new \zc\wechat\models\RequestKeyword();
                $request_keyword->keyword = $keyword;
                $request_keyword->save();
            }else{//已有记录，增加次数
                $request_keyword->updateCounters(['times'=>1]);
            }
            return self::answer("默认回复",$message);
        }else{//关键词匹配
            $response_keyword->updateCounters(['times'=>1]);
            switch ($response_keyword->type){//关键词类型
                case 'image':
                    $response_keyword->reply->updateCounters(['show_times'=>1]);//更新展示次数+1
                    //return ResponsePassive::image($message['fromusername'], $message['tousername'],$response_keyword->reply->mediaid);
                    return new Image(['media_id' => $response_keyword->reply->MediaId]);
                    break;
                case 'voice':
                    $response_keyword->reply->updateCounters(['show_times'=>1]);//更新展示次数+1
                    //return ResponsePassive::voice($message['fromusername'], $message['tousername'],$response_keyword->reply->mediaid);
                    return new Voice(['media_id' => $response_keyword->reply->MediaId]);
                    break;
                case 'video':
                    $response_keyword->reply->updateCounters(['show_times'=>1]);//更新展示次数+1
                    //return ResponsePassive::video($message['fromusername'], $message['tousername'],$response_keyword->reply->mediaid,$response_keyword->reply->title,$response_keyword->reply->description);
                    return new Video(['title' => $response_keyword->reply->title,
                        'media_id' => $response_keyword->reply->MediaId,
                        'description' => $response_keyword->reply->description,
                        'thumb_media_id'  => $response_keyword->reply->ThumbMediaId
                    ]);
                    break;
                case 'news':
                    $items = array();
                    if(count($response_keyword->replys)>1){//多条信息的回复
                        foreach ($response_keyword->replys as $reply) {
                            $reply->updateCounters(['show_times'=>1]);//更新展示次数+1
                            //$items[]= ResponsePassive::newsItem($reply->title,$reply->description,$reply->picture,$reply->url);
                            $items[]= new News([
                                'title'       => $reply->title,
                                'description' => $reply->description,
                                'url'         => $reply->url,
                                'image'       => Yii::$app->glide->createSignedUrl([
                                    'glide/index',
                                    'path' => $reply->img_banner,
                                    'w' => 100
                                ], true),
                            ]);
                        }
                    }else{
                        $response_keyword->reply->updateCounters(['show_times'=>1]);//更新展示次数+1
                        //$items[] = ResponsePassive::newsItem($response_keyword->reply->title,$response_keyword->reply->description,$response_keyword->reply->picture,$response_keyword->reply->url);
                        $items[]= new News([
                            'title'       => $response_keyword->reply->title,
                            'description' => $response_keyword->reply->description,
                            'url'         => $response_keyword->reply->url,
                            'image'       => Yii::$app->glide->createSignedUrl([
                                'glide/index',
                                'path' => $response_keyword->reply->img_banner,
                                'w' => 100
                            ], true),
                        ]);
                    }
                    return $items;
                    break;
                default:
                case 'text':
                    $response_keyword->reply->updateCounters(['show_times'=>1]);//更新展示次数+1
                    //return ResponsePassive::text($message['fromusername'], $message['tousername'],$response_keyword->reply->description);
                    return new Text(['content' => $response_keyword->reply->description]);
                break;

            }

        }
    }
}
