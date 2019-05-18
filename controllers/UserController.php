<?php

namespace app\controllers;

use app\components\AuthHandler;
use app\components\BaseController;
use app\models\LoginForm;
use app\models\User;
use app\models\UserSearch;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use app\models\Wishlist;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends BaseController {
	
	/**
	 * @inheritdoc
	 */
	public function behaviors() {
		return [ 
				'access' => [ 
						'class' => AccessControl::className (),
						
						'only' => [ 
								'logout' 
						],
						'rules' => [ 
								[ 
										'actions' => [ 
												'logout',
												'dashboard',
												'profile',
												'edit-profile' 
										],
										'allow' => true,
										'roles' => [ 
												'@' 
										] 
								],
								[ 
										'actions' => [ 
												'login',
												'signup' 
										],
										'allow' => true,
										'roles' => [ 
												'*',
												'?' 
										] 
								] 
						] 
				],
				'verbs' => [ 
						'class' => VerbFilter::className (),
						'actions' => [ 
								'logout' => [ 
										'post' 
								] 
						] 
				] 
		];
	}
	public function actions() {
		return [ 
				'auth' => [ 
						'class' => 'yii\authclient\AuthAction',
						'successCallback' => [ 
								$this,
								'onAuthSuccess' 
						] 
				] 
		];
	}
	public function onAuthSuccess($client) {
		$this->layout = 'frontend';
		(new AuthHandler ( $client ))->handle ();
		return $this->redirect ( [ 
				'user/profile',
				'id' => \Yii::$app->user->id 
		] );
	}
	public function actionWishlist() {
		$this->layout = 'frontend';
		
		$wishlists = Wishlist::find ()->where ( [ 
				'create_user_id' => \Yii::$app->user->id 
		] )->all ();
		
		return $this->render ( 'wishlist', [ 
				'wishlists' => $wishlists 
		] );
	}
	public function actionProfile($id) {
		$model = $this->findModel ( $id );
		
		return $this->render ( 'profile', [ 
				'model' => $model 
		] );
	}
	public function actionEditProfile($id) {
		$model = $this->findModel ( $id );
		if ($model->load ( \Yii::$app->request->post () )) {
			$oldimage = $model->profile_image;
			$image = UploadedFile::getInstance ( $model, 'profile_image' );
			if (! empty ( $image )) {
				if (! empty ( $image->baseName )) {
					$image->saveAs ( UPLOAD_PATH . '/' . $image->baseName . '.' . $image->extension );
					$model->profile_image = $image->baseName . '.' . $image->extension;
				} else {
					$model->profile_image = $oldimage;
				}
			}
			
			if (! $model->save ()) {
				print_r ( $model->getErrors () );
				exit ();
			}
		}
		
		return $this->redirect ( [ 
				'profile',
				'id' => $model->id 
		] );
	}
	public function actionLogout() {
		Yii::$app->user->logout ();
		
		return $this->goHome ();
	}
	
	/**
	 * Lists all User models.
	 *
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new UserSearch ();
		$dataProvider = $searchModel->search ( Yii::$app->request->queryParams );
		
		return $this->render ( 'index', [ 
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider 
		] );
	}
	public function actionDashboard() {
		return $this->render ( 'dashboard' );
	}
	/**
	 * Displays a single User model.
	 *
	 * @param integer $id        	
	 * @return mixed
	 */
	public function actionView($id) {
		return $this->render ( 'view', [ 
				'model' => $this->findModel ( $id ) 
		] );
	}
	public function actionLogin() {
		$this->layout = '//login';
		$userModel = new User ();
		$userModel->scenario = 'add-user';
		if (! Yii::$app->user->isGuest) {
			return $this->goHome ();
		}
		
		$model = new LoginForm ();
		if ($model->load ( Yii::$app->request->post () ) && $model->login ()) {
			return $this->redirect ( [ 
					'site/index' 
			] );
		}
		return $this->render ( '/user/login', [ 
				'model' => $model,
				'userModel' => $userModel 
		] );
	}
	public function actionAdmin() {
		$this->layout = '//main-login';
		if (! Yii::$app->user->isGuest) {
			return $this->goHome ();
		}
		
		$model = new LoginForm ();
		if ($model->load ( Yii::$app->request->post () ) && $model->login ()) {
			return $this->redirect ( [ 
					'user/dashboard' 
			] );
		}
		return $this->render ( '/site/admin-login', [ 
				'model' => $model 
		] );
	}
	public function actionAddAdmin() {
		$model = new User ();
		$this->layout = 'main-login';
		$model->scenario = 'add-admin';
		$user = User::find ()->count ();
		if (! empty ( $user )) {
			return $this->redirect ( [ 
					'user/login' 
			] );
		}
		if ($model->load ( \yii::$app->request->post () )) {
			if ($model->validate ()) {
				$model->setPassword ();
				if ($model->save ( false )) {
					return $this->redirect ( [ 
							'user/login' 
					] );
				}
			}
		}
		return $this->render ( 'add-admin', [ 
				'model' => $model 
		] );
	}
	public function actionSignup() {
		$this->layout = '//login';
		$model = new User ();
		$model->scenario = 'add-user';
		if ($model->load ( Yii::$app->request->post () )) {
			$model->role_id = User::ROLE_USER;
			$model->state_id = User::STATE_ACTIVE;
			$image = UploadedFile::getInstance ( $model, 'profile_image' );
			if (! empty ( $image )) {
				$image->saveAs ( UPLOAD_PATH . '/' . $image->baseName . '.' . $image->extension );
				$model->profile_image = $image->baseName . '.' . $image->extension;
			}
			if ($model->validate ()) {
				$model->setPassword ();
				if (! $model->save ( false )) {
					\Yii::$app->session->setFlash ( 'error', \Yii::t ( 'app', $model->getErrors () ) );
				}
				
				Yii::$app->user->login ( $model );
			}
			
			return $this->redirect ( [ 
					'/site/index' 
			] );
		}
		
		return $this->render ( 'signup', [ 
				'model' => $model 
		
		] );
	}
	
	/**
	 * Creates a new User model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new User ();
		$model->scenario = 'add-user';
		if ($model->load ( Yii::$app->request->post () )) {
			$model->role_id = User::ROLE_USER;
			$model->state_id = User::STATE_ACTIVE;
			$image = UploadedFile::getInstance ( $model, 'profile_image' );
			if (! empty ( $image )) {
				$image->saveAs ( UPLOAD_PATH . '/' . $image->baseName . '.' . $image->extension );
				$model->profile_image = $image->baseName . '.' . $image->extension;
			}
			if ($model->validate ()) {
				$model->setPassword ();
				if (! $model->save ( false )) {
					\Yii::$app->session->setFlash ( 'error', \Yii::t ( 'app', $model->getErrors () ) );
				}
			}
			
			return $this->redirect ( [ 
					'view',
					'id' => $model->id 
			] );
		} else {
			return $this->render ( 'create', [ 
					'model' => $model 
			] );
		}
	}
	
	/**
	 * Updates an existing User model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id        	
	 * @return mixed
	 */
	public function actionUpdate($id) {
		$model = $this->findModel ( $id );
		$model->scenario = 'update';
		$oldImage = $model->profile_image;
		if ($model->load ( Yii::$app->request->post () )) {
			
			$model->profile_image = $oldImage;
			
			$image = UploadedFile::getInstance ( $model, 'profile_image' );
			if (! empty ( $image )) {
				$image->saveAs ( UPLOAD_PATH . '/' . $image->baseName . '.' . $image->extension );
				$model->profile_image = $image->baseName . '.' . $image->extension;
			}
			
			if (! $model->save ()) {
				\Yii::$app->session->setFlash ( 'error', \Yii::t ( 'app', $model->getErrors () ) );
			}
			return $this->redirect ( [ 
					'view',
					'id' => $model->id 
			] );
		} else {
			return $this->render ( 'update', [ 
					'model' => $model 
			] );
		}
	}
	
	/**
	 * Deletes an existing User model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id        	
	 * @return mixed
	 */
	public function actionChangepassword($id) {
		$model = $this->findModel ( $id );
		$model->scenario = 'changepassword';
		if ($model->load ( Yii::$app->request->post () )) {
			$model->password = $model->newPassword;
			$model->setPassword ();
			if ($model->save ()) {
				return $this->redirect ( [ 
						'user/dashboard' 
				] );
			} else {
				Yii::$app->getSession ()->setFlash ( 'error', 'old password is incorrect' );
			}
		}
		return $this->render ( 'changepassword', [ 
				'model' => $model 
		] );
	}
	public function actionDelete($id) {
		$model = $this->findModel ( $id );
		
		if ($model->role_id == User::ROLE_ADMIN || $model->role_id == \Yii::$app->user->identity->role_id) {
			\Yii::$app->session->setFlash ( "error", \Yii::t ( 'app', 'Can not delete login user or admin' ) );
		} else
			$model->delete ();
		return $this->redirect ( [ 
				'index' 
		] );
	}
	
	/**
	 * Finds the User model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id        	
	 * @return User the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = User::findOne ( $id )) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException ( 'The requested page does not exist.' );
		}
	}
}
