<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_item".
 *
 * @property int $id
 * @property int $order_id
 * @property string $detail
 * @property int $state_id
 * @property int $type_id
 * @property string $created_on
 * @property string $updated_on
 * @property int $create_user_id
 */
class OrderItem extends \yii\db\ActiveRecord {
	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'order_item';
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [ 
				[ 
						[ 
								'order_id',
								'product_id',
								'quantity'
						],
						'required' 
				],
				[ 
						[ 
								'order_id',
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
								'created_on',
								'updated_on' 
						],
						'safe' 
				] 
		];
	}
	public function getCreateUser() {
		return $this->hasOne ( User::className (), [ 
				'id' => 'create_user_id' 
		] );
	}
	public function getOrder() {
		return $this->hasOne ( Order::className (), [ 
				'id' => 'order_id' 
		] );
	}
	public function getProduct() {
		return $this->hasOne ( Product::className (), [
				'id' => 'product_id'
		] );
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [ 
				'id' => Yii::t ( 'app', 'ID' ),
				'order_id' => Yii::t ( 'app', 'Order ID' ),
				'product_id' => Yii::t ( 'app', 'Product ID' ),
				'quantity_id' => Yii::t ( 'app', 'Quantity' ),
				'detail' => Yii::t ( 'app', 'Detail' ),
				'state_id' => Yii::t ( 'app', 'State ID' ),
				'type_id' => Yii::t ( 'app', 'Type ID' ),
				'created_on' => Yii::t ( 'app', 'Created On' ),
				'updated_on' => Yii::t ( 'app', 'Updated On' ),
				'create_user_id' => Yii::t ( 'app', 'Create User ID' ) 
		];
	}
}
