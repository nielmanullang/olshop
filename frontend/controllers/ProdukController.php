<?php

namespace frontend\controllers;

use Yii;
use common\models\Produk;
use common\models\ProdukSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Pembelian;
use common\models\Pelanggan;
use common\models\RatingProduk;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use common\models\Toko;
use yii\web\UploadedFile;
use yii\helpers\Url;

/**
 * ProdukController implements the CRUD actions for Produk model.
 */
class ProdukController extends Controller {

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
     * Lists all Produk models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ProdukSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionHandphone() {
        $searchModel = new ProdukSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['kategori_id' => 1]);

        return $this->render('handphone', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }    
    
    public function actionTelevisi() {
        $searchModel = new ProdukSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['kategori_id' => 2]);

        return $this->render('televisi', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }    

    public function actionKulkas() {
        $searchModel = new ProdukSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['kategori_id' => 3]);

        return $this->render('kulkas', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }        
    
    /**
     * Displays a single Produk model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        if (!Yii::$app->user->isGuest) {
            $ratingproduks = RatingProduk::find()->where(['produk_id' => $id])->orderBy(['rating_id' => SORT_DESC])->limit(7)->all();

            $sql = "SELECT COUNT(rating_produk.rating_produk) FROM rating_produk JOIN produk ON produk.`produk_id` = rating_produk.`produk_id` where rating_produk.produk_id = " . $id;
            $count = Yii::$app->db->createCommand($sql)->queryScalar();
            $sum = (new Query())->select(['rating_produk.rating_produk'])->from('rating_produk')->where(['produk_id' => $id])->sum('rating_produk');
            if ($count == 0) {
                $rating = 0;
            } else {
                $rating = round($sum / $count, 1);
            }

            $ratingproduk = new RatingProduk();
            $pelanggan = Pelanggan::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
            if ($ratingproduk->load(Yii::$app->request->post())) {
                $ratingproduk->produk_id = $id;
                $ratingproduk->pelanggan_id = $pelanggan->pelanggan_id;
                $ratingproduk->save();
                $ratingproduk = new RatingProduk();
            }
            $dataProvider = new ActiveDataProvider(
                    [
                'query' => RatingProduk::find()->where(['produk_id' => $id]),
                'pagination' => [
                    'pageSize' => 10
                ]
                    ]
            );

            return $this->render('view', [
                        'model' => $this->findModel($id),
                        'rating' => $rating,
                        'ratingproduk' => $ratingproduk,
                        'dataProvider' => $dataProvider,
                        'ratingproduks' => $ratingproduks,
            ]);
        } else {
            $ratingproduks = RatingProduk::find()->where(['produk_id' => $id])->orderBy(['rating_id' => SORT_DESC])->limit(7)->all();

            $sql = "SELECT COUNT(rating_produk.rating_produk) FROM rating_produk JOIN produk ON produk.`produk_id` = rating_produk.`produk_id` where rating_produk.produk_id = " . $id;
            $count = Yii::$app->db->createCommand($sql)->queryScalar();
            $sum = (new Query())->select(['rating_produk.rating_produk'])->from('rating_produk')->where(['produk_id' => $id])->sum('rating_produk');
            if ($count == 0) {
                $rating = 0;
            } else {
                $rating = round($sum / $count, 1);
            }

            return $this->render('views', [
                        'model' => $this->findModel($id),
                        'rating' => $rating,
                        'ratingproduks' => $ratingproduks,
            ]);
        }
    }

    public function actionBeli($id) {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['//site/login']);
        } else {
            $pembelian = new Pembelian();
            $pelanggan = Pelanggan::find()->where(['user_id' => Yii::$app->user->identity->id])->one();

            $pembelian->produk_id = $id;
            $pembelian->waktu_pembelian = date('Y-m-d H:i:s');
            $pembelian->pelanggan_id = $pelanggan->pelanggan_id;
            $pembelian->save();

            $produk = Produk::find()->where(['produk_id' => $id])->one();
            $produk->produk_stok--;
            $produk->save();
        }
        return $this->redirect(['//pembelian']);
    }

    /**
     * Creates a new Produk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['//site/login']);
        } else {
            $model = new Produk();
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $pelanggan = Pelanggan::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
                $toko = Toko::find()->where(['pelanggan_id' => $pelanggan])->one();
                $model->toko_id = $toko->toko_id;
                $model->file = UploadedFile::getInstance($model, 'file');
                $path = Url::to("@frontend/web/gambar/produk/");
                for ($i = 0; $i < strlen($path); $i++) {
                    if ($path{$i} == "\\") {
                        $path{$i} = '/';
                    }
                }
                $model->file->saveAs('gambar/produk/' . $model->produk_id . '.' . 'jpg');
                $model->file->saveAs($path . $model->produk_id . '.' . 'jpg');
                $a = $model->save(false);
                if ($a) {
                    Yii::$app->session->setFlash('success', 'Produk Berhasil Ditambahkan!');
                } else {
                    Yii::$app->session->setFlash('error', 'Produk Gagal Ditambahkan!');
                }
                return $this->redirect(['view', 'id' => $model->produk_id]);
            } else {
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        }
    }

    /**
     * Updates an existing Produk model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->produk_id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Produk model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Produk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Produk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Produk::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
