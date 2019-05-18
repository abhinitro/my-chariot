<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%cart}}".
 *
 * @property int $id
 * @property int $product_id
 * @property string $amount
 * @property int $quantity
 * @property string $detail
 * @property string $url
 * @property int $state_id
 * @property int $type_id
 * @property string $created_on
 * @property string $updated_on
 * @property string $cookie_id
 * @property int $create_user_id
 */
class Cart extends \yii\db\ActiveRecord {
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public static function tableName() {
		return '{{%cart}}';
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function rules() {
		return [ 
				[ 
						[ 
								'product_id',
								'amount',
								'quantity' 
						],
						'required' 
				],
				[ 
						[ 
								'product_id',
								'quantity',
								'state_id',
								'type_id',
								'create_user_id' 
						],
						'integer' 
				],
				[ 
						[ 
								'detail' 
						],
						'string' 
				],
				[ 
						[ 
								'amount',
								'created_on',
								'updated_on' 
						],
						'safe' 
				],
				[ 
						[ 
								
								'url',
								'cookie_id' 
						],
						'string',
						'max' => 255 
				] 
		];
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function attributeLabels() {
		return [ 
				'id' => Yii::t ( 'app', 'ID' ),
				'product_id' => Yii::t ( 'app', 'Product ID' ),
				'amount' => Yii::t ( 'app', 'Amount' ),
				'quantity' => Yii::t ( 'app', 'Quantity' ),
				'detail' => Yii::t ( 'app', 'Detail' ),
				'url' => Yii::t ( 'app', 'Url' ),
				'state_id' => Yii::t ( 'app', 'State ID' ),
				'type_id' => Yii::t ( 'app', 'Type ID' ),
				'created_on' => Yii::t ( 'app', 'Created On' ),
				'updated_on' => Yii::t ( 'app', 'Updated On' ),
				'cookie_id' => Yii::t ( 'app', 'Cookie ID' ),
				'create_user_id' => Yii::t ( 'app', 'Create User ID' ) 
		];
	}
	public function getCartItems() {
		$cookies = isset ( $_COOKIE ['cart_items_cookie_id'] ) ? $_COOKIE ['cart_items_cookie_id'] : '';
		if (User::isUser ()) {
			$carts = Cart::findAll ( [ 
					'create_user_id' => \Yii::$app->user->id 
			] );
			if (empty ( $carts )) {
				if (isset ( $cookies )) {
					$carts = Cart::findAll ( [ 
							'cookie_id' => $cookies 
					] );
				}
			}
		} else {
			
			if (isset ( $cookies )) {
				$carts = Cart::findAll ( [ 
						'cookie_id' => $cookies 
				] );
			}
		}
		
		return $carts;
	}
	public function getCreateUser() {
		return $this->hasOne ( User::className (), [ 
				'id' => 'create_user_id' 
		] );
	}
	public function getProduct() {
		return $this->hasOne ( Product::className (), [ 
				'id' => 'product_id' 
		] );
	}
	public function getCount() {
		$cookies = isset ( $_COOKIE ['cart_items_cookie_id'] ) ? $_COOKIE ['cart_items_cookie_id'] : '';
		$cart = 0;
		if (User::isUser ()) {
			
			$cart = self::find ()->where ( [ 
					'create_user_id' => \Yii::$app->user->id 
			] )->count ();
			if (empty ( $cart )) {
				$cart = Cart::find ()->where ( [ 
						'cookie_id' => $cookies 
				] )->count ();
			}
		} else {
			
			if (isset ( $cookies )) {
				$cart = Cart::find ()->where ( [ 
						'cookie_id' => $cookies 
				] )->count ();
			}
		}
		
		return $cart;
	}
	public static function getTotal(){
		$cookies = isset ( $_COOKIE ['cart_items_cookie_id'] ) ? $_COOKIE ['cart_items_cookie_id'] : '';
		$cart = 0;
		if (User::isUser ()) {
				
			$cart = self::find ()->where ( [
					'create_user_id' => \Yii::$app->user->id
			] )->sum ('amount');
			if (empty ( $cart )) {
				$cart = Cart::find ()->where ( [
						'cookie_id' => $cookies
				] )->sum ('amount');
			}
		} else {
				
			if (isset ( $cookies )) {
				$cart = Cart::find ()->where ( [
						'cookie_id' => $cookies
				] )->sum ('amount');
			}
		}
		
		return $cart;
		
	}
	public function asJson() {
		$json = [ ];
		$json ['id'] = $this->id;
		$json ['count'] = $this->getCount ();
		$json ['product_id'] = $this->product_id;
		$json ['image_url'] = $this->product->getImageFile ( $this->product, 'default.jpg', [ 
				'alt' => $this->product->title 
		] );
		$json ['qty'] = $this->quantity;
		$json ['amount'] = $this->amount;
		$json ['product_title'] = $this->product->title;
		
		return $json;
	}
}
