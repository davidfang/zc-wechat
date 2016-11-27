<?php
/**
* WechatController控制器
* Created by David
* User: David.Fang
* Date: 2016-11-15* Time: 23:11:29*/
namespace zc\wechat\admin\controllers;

use Yii;
use zc\wechat\models\Wechat;
use zc\wechat\models\WechatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * WechatController 控制器对 Wechat 模型 CRUD 操作.
 */
class WechatController extends Controller
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
     *  Wechat 模型列表.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WechatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Wechat 模型详情
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
     * Creates a new Wechat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Wechat();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Wechat 模型更新操作
     * 如果更新成功将跳转到“查看”页面
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
                        $oldUrl['img_avatar'] = $model->img_avatar;
                            $oldUrl['img_qrcode'] = $model->img_qrcode;
                    if ($model->load(Yii::$app->request->post())) {
        if ($model->validate()) {
	                $uploadFile = UploadedFile::getInstance($model,'img_avatar');
                if($uploadFile) {
                    $newurl = "uploads/" . date('YmdHis-').rand(100,999). '.' .
                    $uploadFile->extension;
                    $uploadFile->saveAs($newurl);
                    $model->img_avatar = $newurl;
                }else{
                    $model->img_avatar = $oldUrl['img_avatar'];
                }
		                 $uploadFile = UploadedFile::getInstance($model,'img_qrcode');
                if($uploadFile) {
                    $newurl = "uploads/" . date('YmdHis-').rand(100,999). '.' .
                    $uploadFile->extension;
                    $uploadFile->saveAs($newurl);
                    $model->img_qrcode = $newurl;
                }else{
                    $model->img_qrcode = $oldUrl['img_qrcode'];
                }
		                 $model->save();
           	 return $this->redirect(['view', 'id' => $model->id]);
            }else{
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
     * Wechat模型删除操作
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
    * Wechat模型状态修改Ajax操作
    * 备注：将所有主键为$keys的$f字段改为$v状态
    * @param $f 操作字段名
    * @param $v 操作字段值
    * @param array $keys 将修改状态的主键
    * @return array
    * {status: true, msg: "更新成功2条数据。"}
    */
    public function actionChangeStatusAjax($f,$v,array $keys){
        $return = ['status'=>false,'msg'=>''];
        $model = new Wechat();
        $data = $model->updateAll([$f=>$v],['id' => $keys]);
        if($data >0) {
            $return['status'] = true;
            $return['msg'] = '更新成功'.$data.'条数据。';
        }else{
            $return['msg'] = '更新失败';
        }
        Yii::$app->response->format = 'json';
        return $return;
    }
    /**
     * 根据primary key查找 Wechat 模型的信息
     * 如果数据不存在跳转到 404
     * @param integer $id
     * @return Wechat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Wechat::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
