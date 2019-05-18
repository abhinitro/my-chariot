<?php

namespace app\controllers;

use app\components\BaseController;
use app\models\Category;
use app\models\CategorySearch;
use app\modules\media\models\Media;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use app\models\User;
use app\models\Keyword;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends BaseController {
	
	/**
	 * @inheritdoc
	 */
	public function behaviors() {
		return [ 
				'access' => [ 
						'class' => AccessControl::className (),
						'rules' => [ 
								[ 
										'actions' => [ 
												'bulk-delete',
												'index',
												'view',
												'create',
												'update',
												'delete' 
										],
										'allow' => true,
										'matchCallback' => function () {
											return User::isAdmin () || User::isManager ();
										} 
								] 
						] 
				],
				'verbs' => [ 
						'class' => VerbFilter::className (),
						'actions' => [ 
								'delete' => [ 
										'POST' 
								] 
						] 
				] 
		];
	}
	
	/**
	 * Lists all Category models.
	 *
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new CategorySearch ();
		$dataProvider = $searchModel->search ( Yii::$app->request->queryParams );
		
		return $this->render ( 'index', [ 
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider 
		] );
	}
	
	/**
	 * Displays a single Category model.
	 *
	 * @param integer $id        	
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionView($id) {
		return $this->render ( 'view', [ 
				'model' => $this->findModel ( $id ) 
		] );
	}
	
	/**
	 * Creates a new Category model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new Category ();
		$media = new Media ( [ 
				'scenario' => 'add' 
		] );
		$db = \yii::$app->db;
		$transaction = $db->beginTransaction ();
		try {
			if ($model->load ( Yii::$app->request->post () )) {
				// $model->sub_category_id=!empty($model->sub_category_id)?$model->sub_category_id:0;
				if ($model->save ()) {
					
					if (! empty ( $model->keywords )) {
						foreach ( $model->keywords as $keyword ) {
							$keyModel = new Keyword ();
							$keyModel->title = $keyword;
							$keyModel->model_id = $model->id;
							$keyModel->model_type = get_class ( $model );
							$keyModel->save ();
						}
					}
					
					if ($media->saveFile ( $media, $model, 'file_name', null, 'thumb_file' )) {
						$transaction->commit ();
						return $this->redirect ( [ 
								'view',
								'id' => $model->id 
						] );
					} else {
						\yii::$app->session->setFlash ( 'error', \yii::t ( 'app', "File Not Uploaded" ) );
					}
				} else {
					\yii::$app->session->setFlash ( 'error', $model->errorString () );
				}
			}
		} catch ( \Exception $e ) {
			$transaction->rollback ();
			\yii::$app->session->setFlash ( 'error', $e->getMessage () );
		}
		
		return $this->render ( 'create', [ 
				'model' => $model,
				'media' => $media 
		] );
	}
	
	/**
	 * Updates an existing Category model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id        	
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate($id) {
		$model = $this->findModel ( $id );
		$media = Media::find ()->where ( [ 
				'model_id' => $model->id,
				'model_type' => get_class ( $model ) 
		] )->one ();
		$oldFile = '';
		$oldThumbFile = '';
		if (empty ( $media )) {
			$media = new Media ();
		} else {
			$oldFile = $media->file_name;
			$oldThumbFile = $media->thumb_file;
		}
		if ($model->load ( Yii::$app->request->post () ) && $model->save ()) {
			$media->saveFile ( $media, $model, 'file_name', $oldFile, $oldThumbFile );
			
			return $this->redirect ( [ 
					'view',
					'id' => $model->id 
			] );
		}
		
		return $this->render ( 'update', [ 
				'model' => $model,
				'media' => $media 
		] );
	}
	
	/**
	 * Deletes an existing Category model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id        	
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionDelete($id) {
		$this->findModel ( $id )->delete ();
		
		return $this->redirect ( [ 
				'index' 
		] );
	}
	
	/**
	 * Finds the Category model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id        	
	 * @return Category the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = Category::findOne ( $id )) !== null) {
			return $model;
		}
		
		throw new NotFoundHttpException ( Yii::t ( 'app', 'The requested page does not exist.' ) );
	}
}
