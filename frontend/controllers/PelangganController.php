<?php

namespace frontend\controllers;

use Yii;
use common\models\Pelanggan;
use common\models\PelangganSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Provinsi;
use common\models\Kabupaten;
use common\models\Kecamatan;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
/**
 * PelangganController implements the CRUD actions for Pelanggan model.
 */
class PelangganController extends Controller {

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
     * Lists all Pelanggan models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new PelangganSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionListKabupaten($id) {
        $countprovinsi = Provinsi::find()->where(['provinsi_id' => $id])->count();

        $provinsis = Kabupaten::find()->where(['provinsi_id' => $id])->orderBy('nama ASC')->all();
        if ($countprovinsi > 0) {
            foreach ($provinsis as $result)
                echo "<option value='" . $result->provinsi_id . "'>" . $result->nama . "</option>";
        } else {
            echo "<option>-</option>";
        }
    }

    public function actionGet() {

            $request = Yii::$app->request;
            $obj = $request->post('obj');
            $value = $request->post('value');
            $id = null;
            $name = null;
            echo $obj;
            switch ($obj) {
                case 'provinsi_id':
                    $data = Kabupaten::find()->where([$obj => $value])->all();
                    $id = 'kabupaten_id';
                    $name = 'nama';
                    break;
                case 'kabupaten_id':
                    $data = Kecamatan::find()->where([$obj => $value])->all();
                    $id = 'kecamatan_id';
                    $name = 'nama';
                    break;
            }
            $tagOptions = ['prompt' => "=== Select ==="];
            return Html::renderSelectOptions([], ArrayHelper::map($data, $id, $name), $tagOptions);       
    }
    
    public function actionListKecamatan($id) {
        $countkabupaten = Kabupaten::find()->where(['kabupaten_id' => $id])->count();

        $kabupatens = Kecamatan::find()->where(['kabupaten_id' => $id])->orderBy('nama ASC')->all();
        if ($countkabupaten > 0) {
            foreach ($kabupatens as $result)
                echo "<option value='" . $result->kabupaten_id . "'>" . $result->nama . "</option>";
        } else {
            echo "<option>-</option>";
        }
    }

    /**
     * Displays a single Pelanggan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pelanggan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Pelanggan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pelanggan_id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pelanggan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pelanggan_id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pelanggan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pelanggan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pelanggan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Pelanggan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
