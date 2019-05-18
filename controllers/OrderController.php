<?php

namespace app\controllers;

use Yii;
use app\models\Order;
use app\models\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\User;
use app\models\Cart;
use app\models\OrderItem;
use yii\data\ActiveDataProvider;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller {
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
												'delete',
												'order-success'
										],
										'allow' => true,
										'matchCallback' => function () {
											return User::isAdmin () || User::isManager ();
										} 
								],
								[ 
										'actions' => [ 
												'checkout',
												'cart',
												'get-search',
												'order-success'
										],
										'allow' => true,
										'roles' => [ 
												'*',
												'@',
												'?' 
										] 
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
	 * Lists all Order models.
	 *
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new OrderSearch ();
		$dataProvider = $searchModel->search ( Yii::$app->request->queryParams );
		
		return $this->render ( 'index', [ 
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider 
		] );
	}
	public function actionOrderSuccess($id) {

		$this->layout = "frontend";
		
		$order = Order::findOne ( $id );
		
		return $this->render ( 'order_success', [ 
				'order' => $order 
		] );
	}
	public function actionCheckout() {
		$this->layout = "frontend";
		$order = new Order ();
		$order->scenario = 'checkout';
		$cookies = isset ( $_COOKIE ['cart_items_cookie_id'] ) ? $_COOKIE ['cart_items_cookie_id'] : '';
		$cart = Cart::find ()->where ( [ 
				'OR',
				[ 
						'cookie_id' => $cookies 
				],
				[ 
						'create_user_id' => \Yii::$app->user->id 
				] 
		] );
		$cartItem = $cart->all ();
		
		$db = \yii::$app->db;
		$post = Yii::$app->request->post ();
		// $transaction = $db->beginTransaction();
		try {  
			//var_dump($post);exit;
			
			if ($order->load ( Yii::$app->request->post () )) {
				$order->full_name =$order->firstName ." ".$order->lastName;

				
				if ($order->save ()) {
					
					foreach ( $cartItem as $item ) {
						$order_item = new OrderItem ();
						$order_item->order_id = $order->id;
				
						$order_item->product_id = $item->product_id;
						$order_item->quantity = $item->quantity;
						if ($order_item->save ()) {
							$item->delete ();
						} else {
							var_dump ( $order_item->getErrors () );
							exit ();
						}
					}
					
					unset ( $_COOKIE ['cart_items_cookie_id'] );
				} else {
					print_r ( $order->getErrors());
					exit ();
				}
				
				return $this->redirect ( [ 
						'order-success',
						'id' => $order->id 
				] );
			}
		} catch ( \Exception $e ) {
			// $transaction->rollback();
			var_dump ( $e->getMessage () );
			exit ();
			\yii::$app->session->setFlash ( 'danger', $e->getMessage () );
		}
		
		$dataProvider = new ActiveDataProvider ( [ 
				'query' => $cart,
				'pagination' => [ 
						'pageSize' => 2 
				],
				'sort' => [ 
						'defaultOrder' => [ 
								'created_on' => SORT_DESC 
						] 
				] 
		] );
		return $this->render ( 'checkout', [ 
				'model' => $order,
				'dataProvider' => $dataProvider 
		] );
	}
	public function actionCart() {
		$this->layout = "frontend";
		$carts = [ ];
		if (isset ( $_COOKIE ['cart_items_cookie_id'] )) {
			$carts = Cart::findAll ( [ 
					'cookie_id' => $_COOKIE ['cart_items_cookie_id'] 
			] );
		}
		if (User::isUser ()) {
			if (! empty ( $carts )) {
				foreach ( $carts as $carts ) {
					$cart->create_user_id = \Yii::$app->user->id;
					$cart->save ();
				}
			} else {
				$carts = Cart::findAll ( [ 
						'create_user_id' => \Yii::$app->user->id 
				] );
			}
		}
		
		return $this->render ( 'cart', [ 
				'carts' => $carts 
		] );
	}
	
	/**
	 * Displays a single Order model.
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
	 * Creates a new Order model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new Order ();
		
		if ($model->load ( Yii::$app->request->post () ) && $model->save ()) {
			return $this->redirect ( [ 
					'view',
					'id' => $model->id 
			] );
		}
		
		return $this->render ( 'create', [ 
				'model' => $model 
		] );
	}
	
	/**
	 * Updates an existing Order model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id        	
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate($id) {
		$model = $this->findModel ( $id );
		
		if ($model->load ( Yii::$app->request->post () ) && $model->save ()) {
			return $this->redirect ( [ 
					'view',
					'id' => $model->id 
			] );
		}
		
		return $this->render ( 'update', [ 
				'model' => $model 
		] );
	}
	
	/**
	 * Deletes an existing Order model.
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
	 * Finds the Order model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id        	
	 * @return Order the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = Order::findOne ( $id )) !== null) {
			return $model;
		}
		
		throw new NotFoundHttpException ( 'The requested page does not exist.' );
	}
}
