<?php
/**
 * SceneController控制器
 * Created by David
 * User: David.Fang
 * Date: 2016-11-29* Time: 14:24:53*/
namespace zc\wechat\admin\controllers;

use Yii;
use zc\wechat\models\Scene;
use zc\wechat\models\SceneSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use zc\wechat\models\Wechat;

/**
 * SceneController 控制器对 Scene 模型 CRUD 操作.
 */
class SceneController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     *  Scene 模型列表.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SceneSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Scene 模型详情
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Scene model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Scene();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->isCreated) {//直接生成二维码
                $app = Wechat::getApplication($model->wechat_id);
                $qrcode = $app->qrcode;
                if ($model->type == 1) {//临时二维码
                    $result = $qrcode->temporary($model->sceneId, $model->expireSeconds);//(56, 6 * 24 * 3600);
                    $model->Ticket = $result->ticket;// 或者 $result['ticket']
                    $model->expireSeconds = $result->expire_seconds; // 有效秒数
                    $model->url = $qrcode->url($result->ticket); // 二维码图片解析后的地址，开发者可根据该地址自行生成需要的二维码图片

                } elseif ($model->type == 2) {//永久二维码
                    $result = $qrcode->forever(56);// 或者 $qrcode->forever("foo");
                    $model->Ticket = $result->ticket; // 或者 $result['ticket']
                    $model->url = $result->url;
                }
            }
            if ($model->save()) {
                return $this->redirect(['index']);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Scene 模型更新操作
     * 如果更新成功将跳转到“查看”页面
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->isCreated) {//直接生成二维码
                $app = Wechat::getApplication($model->wechat_id);
                $qrcode = $app->qrcode;
                if ($model->type == 1) {//临时二维码
                    $result = $qrcode->temporary($model->sceneId, $model->expireSeconds);//(56, 6 * 24 * 3600);
                    $model->Ticket = $result->ticket;// 或者 $result['ticket']
                    $model->expireSeconds = $result->expire_seconds; // 有效秒数
                    $model->url = $result->url; // 二维码图片解析后的地址，开发者可根据该地址自行生成需要的二维码图片

                } elseif ($model->type == 2) {//永久二维码
                    $result = $qrcode->forever(56);// 或者 $qrcode->forever("foo");
                    $model->Ticket = $result->ticket; // 或者 $result['ticket']
                    $model->url = $qrcode->url($result->ticket);
                }
            }
            if ($model->validate()) {
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Scene模型删除操作
     * 如果删除成功，跳转到“列表”页
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Scene模型状态修改Ajax操作
     * 备注：将所有主键为$keys的$f字段改为$v状态
     * @param $f 操作字段名
     * @param $v 操作字段值
     * @param array $keys 将修改状态的主键
     * @return array
     * {status: true, msg: "更新成功2条数据。"}
     */
    public function actionChangeStatusAjax($f, $v, array $keys)
    {
        $return = ['status' => false, 'msg' => ''];
        $model = new Scene();
        $data = $model->updateAll([$f => $v], ['id' => $keys]);
        if ($data > 0) {
            $return['status'] = true;
            $return['msg'] = '更新成功' . $data . '条数据。';
        } else {
            $return['msg'] = '更新失败';
        }
        Yii::$app->response->format = 'json';
        return $return;
    }

    /**
     * 根据primary key查找 Scene 模型的信息
     * 如果数据不存在跳转到 404
     * @param integer $id
     * @return Scene the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Scene::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionTest($id)
    {
        $model = $this->findModel($id);

        $app = Wechat::getApplication($model->wechat_id);
        $qrcode = $app->qrcode;

        $url = $qrcode->url($model->Ticket);
        echo $url;
        exit;
    }
}
