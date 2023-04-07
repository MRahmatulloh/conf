<?php

namespace app\controllers;

use app\models\Category;
use app\models\Conference;
use app\models\search\CategorySearch;
use app\models\search\ConferenceSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ConferenceController implements the CRUD actions for Conference model.
 */
class ConferenceController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Conference models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ConferenceSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Conference models.
     *
     * @return string
     */
    public function actionList()
    {
        $searchModel = new ConferenceSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Conference model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Conference model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDetails($id)
    {
        return $this->render('details', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Conference model.
     * @param int $id ID
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDirections($id)
    {
        $conference = $this->findModel($id);
        $model = new Category([
            'conference_id' => $id,
        ]);
        $searchModel = new CategorySearch();
        $searchModel->conference_id = $id;
        $dataProvider = $searchModel->search($this->request->queryParams);

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Данные успешно сохранены'));
                    return $this->redirect(Yii::$app->request->referrer);
                } else {
                    Yii::$app->session->setFlash('error', Yii::t('app', 'Произошла ошибка при сохранении данных'));
                }
            }
        }

        return $this->render('directions', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Conference model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Conference();
        $model->scenario = 'create';
        $model->status = 1;

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->file = UploadedFile::getInstance($model, 'file');
                if ($model->validate()) {
                    if ($model->file) {
                        $last_id = ((Conference::find()
                                ->orderBy(['id' => SORT_DESC])
                                ->one())->id ?? 0) + 1;
                        $fileName = $last_id . '_' . time() . '.' . $model->file->extension;
                        $model->file->saveAs('files/conferences/' . $fileName, false);
                        $model->filename = $fileName;
                    }

                    if ($model->save(false)) {
                        Yii::$app->session->setFlash('success', Yii::t('app', 'Конференция успешно создана'));
                        return $this->redirect(['directions', 'id' => $model->id]);
                    } else {
                        Yii::$app->session->setFlash('error', Yii::t('app', 'Произошла ошибка при сохранении данных'));
                    }
                }
            }
        }


        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Conference model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->file = UploadedFile::getInstance($model, 'file');
                if ($model->validate()) {
                    if ($model->file) {
                        $last_id = $model->id;
                        $fileName = $last_id . '_' . time() . '.' . $model->file->extension;
                        $model->file->saveAs('files/conferences/' . $fileName, false);
                        $model->filename = $fileName;
                    }

                    if ($model->save(false)) {
                        Yii::$app->session->setFlash('success', Yii::t('app', 'Данные успешно сохранены'));
                        return $this->redirect(['index']);
                    } else {
                        Yii::$app->session->setFlash('error', Yii::t('app', 'Произошла ошибка при сохранении данных'));
                    }
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Conference model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionApply($id){
        $model = $this->findModel($id);
        $model->status = 1;
        if($model->save()){
            Yii::$app->session->setFlash('success', Yii::t('app', 'Конференция успешно опубликована'));
        }else{
            Yii::$app->session->setFlash('error', Yii::t('app', 'Произошла ошибка при сохранении данных'));
        }
        return $this->redirect(['index']);

    }

    /**
     * Finds the Conference model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Conference the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Conference::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
