<?php

namespace jberall\fileupload\controllers;

use Yii;
use jberall\fileupload\models\FileUpload;
use jberall\fileupload\models\FileUploadSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * FileUploadController implements the CRUD actions for FileUpload model.
 */
class FileUploadController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    
    public function actionImage($id) {
        $model = $this->findModel($id);
        
        Yii::$app->response->format = yii\web\Response::FORMAT_RAW;
        Yii::$app->response->headers->add('content-type',$model->mime_type);
        Yii::$app->response->data = hex2bin(stream_get_contents($model->file_blob)); //file_get_contents('file.png');
        return Yii::$app->response;          
    }
    
    public function actionUpload()
    {
        $model = new FileUpload();

        if ($model->load(Yii::$app->request->post())) {
            $model->uploadedFiles = UploadedFile::getInstances($model, 'uploadedFiles');
            if ($model->upload()) {
                // file is uploaded successfully
                return $this->redirect(['view', 'id' => $model->id]);
                
            }
        }

        return $this->render('upload', ['model' => $model]);
    }    
    
    /**
     * Lists all FileUpload models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FileUploadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FileUpload model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Updates an existing FileUpload model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FileUpload model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FileUpload model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return FileUpload the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FileUpload::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
