<?php

namespace frontend\controllers;

use Yii;
use common\models\Toko;
use common\models\TokoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Pelanggan;
use common\models\Produk;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use yii\helpers\Url;
use common\models\RatingToko;

/**
 * TokoController implements the CRUD actions for Toko model.
 */
class TokoController extends Controller {

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
     * Lists all Toko models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TokoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexSaya() {
//        $searchModel = new TokoSearch();
        $pelanggan = Pelanggan::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
        $toko = Toko::find()->where(['pelanggan_id' => $pelanggan->pelanggan_id])->one();

        if ($toko == NULL) {
            return $this->redirect('?r=toko/create');
        } else {
            return $this->redirect('?r=toko/toko-saya&id=' . $toko->toko_id);
        }
    }

    public function actionTokoSaya($id) {
        $ratingtokos = RatingToko::find()->where(['toko_id' => $id])->orderBy(['rating_id' => SORT_DESC])->limit(7)->all();

        $sql = "SELECT COUNT(rating_toko.`rating_toko`) FROM rating_toko JOIN toko ON toko.`toko_id` = rating_toko.`toko_id` where rating_toko.toko_id = " . $id;
        $count = Yii::$app->db->createCommand($sql)->queryScalar();
        $sum = (new \yii\db\Query())->select(['rating_toko.rating_toko'])->from('rating_toko')->where(['toko_id' => $id])->sum('rating_toko');
        if ($count == 0) {
            $rating = 0;
        } else {
            $rating = round($sum / $count, 1);
        }

        $produk = new Produk();
        $toko = Toko::find()->where(['toko_id' => $id])->one();
        $produks = Produk::find()->where(['toko_id' => $toko->toko_id]);

        $dataProvider = new ActiveDataProvider(
                [
            'query' => $produks,
            'pagination' => [
                'pageSize' => 10
            ]
                ]
        );
        return $this->render('toko-saya', [
                    'rating' => $rating,
                    'model' => $toko,
                    'produk' => $produk,
                    'dataProvider' => $dataProvider]);
    }

    /**
     * Displays a single Toko model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        if (!Yii::$app->user->isGuest) {
            $ratingtokos = RatingToko::find()->where(['toko_id' => $id])->orderBy(['rating_id' => SORT_DESC])->limit(7)->all();

            $sql = "SELECT COUNT(rating_toko.`rating_toko`) FROM rating_toko JOIN toko ON toko.`toko_id` = rating_toko.`toko_id` where rating_toko.toko_id = " . $id;
            $count = Yii::$app->db->createCommand($sql)->queryScalar();
            $sum = (new \yii\db\Query())->select(['rating_toko.rating_toko'])->from('rating_toko')->where(['toko_id' => $id])->sum('rating_toko');
            if ($count == 0) {
                $rating = 0;
            } else {
                $rating = round($sum / $count, 1);
            }
            $produk = new Produk();
            $toko = Toko::find()->where(['toko_id' => $id])->one();
            $produks = Produk::find()->where(['toko_id' => $toko->toko_id]);

            $dataProvider = new ActiveDataProvider(
                    [
                'query' => $produks,
                'pagination' => [
                    'pageSize' => 10
                ]
                    ]
            );

            $ratingtoko = new RatingToko();
            $pelanggan = Pelanggan::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
            if ($ratingtoko->load(Yii::$app->request->post())) {
                $ratingtoko->toko_id = $id;
                $ratingtoko->pelanggan_id = $pelanggan->pelanggan_id;
                $ratingtoko->save();
                $ratingtoko = new RatingToko();
            }
            $dataProviders = new ActiveDataProvider(
                    [
                'query' => RatingToko::find()->where(['toko_id' => $id]),
                'pagination' => [
                    'pageSize' => 10
                ]
                    ]
            );

            return $this->render('view', [
                        'rating' => $rating,
                        'ratingtoko' => $ratingtoko,
                        'ratingtokos' => $ratingtokos,
                        'model' => $toko,
                        'produk' => $produk,
                        'dataProvider' => $dataProvider,
                        'dataProviders' => $dataProviders,
            ]);
        } else {
            $ratingtokos = RatingToko::find()->where(['toko_id' => $id])->orderBy(['rating_id' => SORT_DESC])->limit(7)->all();

            $sql = "SELECT COUNT(rating_toko.`rating_toko`) FROM rating_toko JOIN toko ON toko.`toko_id` = rating_toko.`toko_id` where rating_toko.toko_id = " . $id;
            $count = Yii::$app->db->createCommand($sql)->queryScalar();
            $sum = (new \yii\db\Query())->select(['rating_toko.rating_toko'])->from('rating_toko')->where(['toko_id' => $id])->sum('rating_toko');
            if ($count == 0) {
                $rating = 0;
            } else {
                $rating = round($sum / $count, 1);
            }
            $produk = new Produk();
            $toko = Toko::find()->where(['toko_id' => $id])->one();
            $produks = Produk::find()->where(['toko_id' => $toko->toko_id]);

            $dataProvider = new ActiveDataProvider(
                    [
                'query' => $produks,
                'pagination' => [
                    'pageSize' => 10
                ]
                    ]
            );

            return $this->render('views', [
                        'rating' => $rating,
                        'ratingtokos' => $ratingtokos,
                        'model' => $toko,
                        'produk' => $produk,
                        'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Creates a new Toko model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['//site/login']);
        } else {
            $model = new Toko();
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $pelanggan = Pelanggan::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
                $model->pelanggan_id = $pelanggan->pelanggan_id;
                $model->file = UploadedFile::getInstance($model, 'file');
                $path = Url::to("@frontend/web/gambar/logotoko/");
                for ($i = 0; $i < strlen($path); $i++) {
                    if ($path{$i} == "\\") {
                        $path{$i} = '/';
                    }
                }
                $model->file->saveAs('gambar/logotoko/' . $model->toko_id . '.' . 'jpg');
                $model->file->saveAs($path . $model->toko_id . '.' . 'jpg');
                $a = $model->save();
                if ($a) {
                    Yii::$app->session->setFlash('success', 'Toko Berhasil Ditambahkan!');
                } else {
                    Yii::$app->session->setFlash('error', 'Toko Gagal Ditambahkan!');
                }
                return $this->redirect(['toko-saya', 'id' => $model->toko_id]);
            } else {
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        }
    }

    /**
     * Updates an existing Toko model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['toko-saya', 'id' => $model->toko_id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Toko model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Toko model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Toko the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Toko::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
