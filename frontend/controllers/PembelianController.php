<?php

namespace frontend\controllers;

use Yii;
use common\models\Pembelian;
use common\models\PembelianSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Pelanggan;
use common\models\Toko;
use yii\data\SqlDataProvider;

/**
 * PembelianController implements the CRUD actions for Pembelian model.
 */
class PembelianController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pembelian models.
     * @return mixed
     */

    public function actionIndex() {
        $searchModel = new KategoriSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionViewPembeli() {
        $pelanggan = Pelanggan::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
        $searchModel = new PembelianSearch();
        $dataProvider = new SqlDataProvider([
            'sql' => "SELECT pembelian.pembelian_id, pembelian.waktu_pembelian AS 'Waktu_Pembelian', 
                    produk.produk_nama AS 'Nama_Barang', produk.produk_harga AS 'Harga', produk.produk_ongkos_kirim AS 'Biaya_Pengiriman', 
                    toko.toko_nama AS 'Toko_Penjual', toko.toko_alamat AS 'Dikirim_Dari'
                    FROM produk JOIN toko ON produk.toko_id = toko.toko_id
                    JOIN pembelian ON produk.produk_id = pembelian.produk_id 
                    JOIN pelanggan ON pembelian.pelanggan_id = pelanggan.pelanggan_id
                    JOIN kabupaten ON kabupaten.kabupaten_id = pelanggan.pelanggan_kabupaten
                    WHERE pembelian.pelanggan_id = " . $pelanggan->pelanggan_id
        ]);

        return $this->render('view-pembeli', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionViewPenjual() {
        $pelanggan = Pelanggan::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
        $toko = Toko::find()->where(['pelanggan_id' => $pelanggan->pelanggan_id])->one();
        $searchModel = new PembelianSearch();
        $dataProvider = new SqlDataProvider([
            'sql' => "SELECT pembelian.pembelian_id, pembelian.waktu_pembelian AS 'Waktu_Pembelian', 
                    produk.produk_nama AS 'Nama_Barang', produk.produk_harga AS 'Harga', produk.produk_ongkos_kirim AS 'Biaya_Pengiriman', 
                    pelanggan.pelanggan_nama AS 'Nama_Pembeli', kabupaten.nama AS 'Dikirim_ke'
                    FROM produk JOIN toko ON produk.toko_id = toko.toko_id
                    JOIN pembelian ON produk.produk_id = pembelian.produk_id 
                    JOIN pelanggan ON pembelian.pelanggan_id = pelanggan.pelanggan_id
                    JOIN kabupaten ON kabupaten.kabupaten_id = pelanggan.pelanggan_kabupaten
                    WHERE toko.toko_id = " . $toko->toko_id
        ]);

        return $this->render('view-penjual', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }    
    
    /**
     * Displays a single Pembelian model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pembelian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Pembelian();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pembelian_id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pembelian model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pembelian_id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pembelian model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pembelian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pembelian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Pembelian::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
