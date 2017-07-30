<?php

namespace frontend\controllers;

use Yii;
use common\models\Kategori;
use common\models\KategoriSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use common\models\Produk;

/**
 * KategoriController implements the CRUD actions for Kategori model.
 */
class KategoriController extends Controller {

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
     * Lists all Kategori models.
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

    /**
     * Displays a single Kategori model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $produk = new Produk();
        $kategori = Kategori::find()->where(['kategori_id' => $id])->one();
        $produks = Produk::find()->where(['kategori_id' => $kategori->kategori_id]);

        $dataProvider = new ActiveDataProvider(
                [
            'query' => $produks,
            'pagination' => [
                'pageSize' => 10
            ]
                ]
        );
        return $this->render('view', [
                    'model' => $kategori,
                    'produk' => $produk,
                    'dataProvider' => $dataProvider]);
    }

    public function actionHandphone() {
        $produk = new Produk();
        $searchModel = new KategoriSearch();
        $kategori = Kategori::find()->where(['kategori_id' => 1]);
        $produks = Produk::find()->where(['kategori_id' => 1]);

        $dataProvider = new ActiveDataProvider(
                [
            'query' => $produks,
            'pagination' => [
                'pageSize' => 10
            ]
                ]
        );
        return $this->render('handphone', [
                    'model' => $kategori,
                    'produk' => $produk,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider]);
    }

    public function actionTelevisi() {
        $produk = new Produk();
        $kategori = Kategori::find()->where(['kategori_id' => 2]);
        $produks = Produk::find()->where(['kategori_id' => 2]);

        $dataProvider = new ActiveDataProvider(
                [
            'query' => $produks,
            'pagination' => [
                'pageSize' => 10
            ]
                ]
        );
        return $this->render('televisi', [
                    'model' => $kategori,
                    'produk' => $produk,
                    'dataProvider' => $dataProvider]);
    }

    public function actionKulkas() {
        $produk = new Produk();
        $kategori = Kategori::find()->where(['kategori_id' => 3]);
        $produks = Produk::find()->where(['kategori_id' => 3]);

        $dataProvider = new ActiveDataProvider(
                [
            'query' => $produks,
            'pagination' => [
                'pageSize' => 10
            ]
                ]
        );
        return $this->render('kulkas', [
                    'model' => $kategori,
                    'produk' => $produk,
                    'dataProvider' => $dataProvider]);
    }

    /**
     * Creates a new Kategori model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Kategori();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->kategori_id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Kategori model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->kategori_id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Kategori model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Kategori model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Kategori the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Kategori::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
