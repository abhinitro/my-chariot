<?php

namespace app\controllers;

use Yii;
use app\models\Cart;
use app\models\CartSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Cookie;
use app\models\User;
use app\models\Product;
use yii\filters\AccessControl;
use app\models\Wishlist;

/**
 * CartController implements the CRUD actions for Cart model.
 */
class CartController extends Controller {
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function behaviors() {
		return [ 
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
	 * Lists all Cart models.
	 *
	 * @return mixed
	 */
	function getToken($length) {
		$token = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
		$codeAlphabet .= "0123456789";
		$max = strlen ( $codeAlphabet ); // edited
		
		for($i = 0; $i < $length; $i ++) {
			$token .= $codeAlphabet [random_int ( 0, $max - 1 )];
		}
		
		return $token;
	}
	public function AddToCartLoginUser($post) {
		$cart = Cart::find ()->where ( [ 
				'create_user_id' => \Yii::$app->user->id,
				'product_id' => $post ['product_id'] 
		] )->one ();
		
		if (empty ( $cart )) {
			$cart = new Cart ();
			$cart->amount = $post ['amount'] * $post ['qty'];
			$cart->product_id = $post ['product_id'];
			$cart->create_user_id = \Yii::$app->user->id;
			$cart->quantity = $post ['qty'];
			
			if ($cart->save ()) {
				$data ['status'] = \Yii::t ( 'app', 'Success!' );
				$data ['details'] = $cart->asJson ();
				$data ['message'] = \Yii::t ( 'app', 'Added to Cart' );
				$data ['flag'] = 1;
				return $data;
			}
		} else {
			
			$cart->amount = $post ['amount'] * ($cart->quantity + $post ['qty']);
			$cart->quantity = $cart->quantity + $post ['qty'];
			if ($cart->save ()) {
				$data ['status'] = \Yii::t ( 'app', 'Success!' );
				$data ['details'] = $cart->asJson ();
				$data ['message'] = \Yii::t ( 'app', 'Added to Cart' );
				$data ['flag'] = 2;
				return $data;
			}
		}
		
		$data ['status'] = \Yii::t ( 'app', 'Error' );
		$data ['message'] = \Yii::t ( 'app', 'Already Exist' );
		
		return $data;
	}
	public function AddToCartGuestUser($post) {
		
		// add new item on array
		// read
		$cookie = isset ( $_COOKIE ['cart_items_cookie_id'] ) ? $_COOKIE ['cart_items_cookie_id'] : "";
		$cookie = stripslashes ( $cookie );
		$saved_cart_items = $cookie;
		
		// if $saved_cart_items is null, prevent null error
		if (empty ( $saved_cart_items )) {
			$saved_cart_items = $this->getToken ( 15 );
		}
		
		$cart = Cart::find ()->where ( [ 
				'cookie_id' => $saved_cart_items,
				'product_id' => $_POST ['product_id'] 
		] )->one ();
		
		if (empty ( $cart )) {
			
			$cart_items = $saved_cart_items;
			// put item to cookie
			$json = $saved_cart_items;
			setcookie ( "cart_items_cookie_id", $json, time () + (86400 * 30), '/' ); // 86400 = 1 day
			$_COOKIE ['cart_items_cookie_id'] = $json;
			$cart = new Cart ();
			$cart->cookie_id = $_COOKIE ['cart_items_cookie_id'];
			$cart->amount = $post ['amount'] * $post ['qty'];
			$cart->product_id = $post ['product_id'];
			$cart->quantity = $post ['qty'];
			if ($cart->save ()) {
				$data ['status'] = \Yii::t ( 'app', 'Success!' );
				$data ['details'] = $cart->asJson ();
				$data ['message'] = \Yii::t ( 'app', 'Added to Cart' );
				$data ['flag'] = 1;
				
				return $data;
			} else {
				print_r ( $cart->getErrors () );
				exit ();
			}
		} else {
			$cart->amount = $post ['amount'] * ($cart->quantity + $post ['qty']);
			$cart->quantity = $cart->quantity + $post ['qty'];
			if ($cart->save ()) {
				$data ['status'] = \Yii::t ( 'app', 'Success!' );
				$data ['details'] = $cart->asJson ();
				$data ['message'] = \Yii::t ( 'app', 'Added to Cart' );
				$data ['flag'] = 2;
				return $data;
			}
		}
		$data ['status'] = \Yii::t ( 'app', 'Error!' );
		$data ['message'] = \Yii::t ( 'app', 'Already Exist' );
		
		return $data;
	}
	public function actionAddToCart() {
		\Yii::$app->response->format = 'json';
		$data = [ ];
		if (isset ( $_POST ['product_id'] ) && isset ( $_POST ['amount'] ) && $_POST ['qty']) {
			if (User::isUser ()) {
				$data = $this->AddToCartLoginUser ( $_POST );
				return $data;
			} else {
				$data = $this->AddToCartGuestUser ( $_POST );
				return $data;
			}
		} else {
			
			$data ['status'] = \Yii::t ( 'app', 'Error!' );
			$data ['message'] = \Yii::t ( 'app', 'No Data Posted' );
		}
		
		return $data;
	}
	public function actionIndex() {
		$searchModel = new CartSearch ();
		$dataProvider = $searchModel->search ( Yii::$app->request->queryParams );
		
		return $this->render ( 'index', [ 
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider 
		] );
	}
	
	/**
	 * Displays a single Cart model.
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
	 * Creates a new Cart model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new Cart ();
		
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
	 * Updates an existing Cart model.
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
	public function actionUpdateQuantity() {
		$id = $_POST ['id'];
		$count = $_POST ['count'];
		$model = Cart::findOne ( $id );
		$product = Product::findOne ( $model->product_id );
		$amount = $product->getDiscountPrice ();
		$model->quantity = $count;
		$model->amount = $amount * $count;
		$model->save ();
	}
	/**
	 * Deletes an existing Cart model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id        	
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionDeleteFromCart($id) {
		$model = Cart::findOne ( $id );
		
		$model->delete ();
		return $this->redirect ( \Yii::$app->request->referrer );
	}
	
	public function actionDeleteFromWishlist($id) {
		$model = Wishlist::findOne ( $id );
		
		$model->delete ();
		return $this->redirect ( \Yii::$app->request->referrer );
	}
	
	public function actionDelete($id) {
		$this->findModel ( $id )->delete ();
		
		return $this->redirect ( [ 
				'index' 
		] );
	}
	
	/**
	 * Finds the Cart model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id        	
	 * @return Cart the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = Cart::findOne ( $id )) !== null) {
			return $model;
		}
		
		throw new NotFoundHttpException ( Yii::t ( 'app', 'The requested page does not exist.' ) );
	}
}
