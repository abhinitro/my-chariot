<?php

namespace app\models;

use Yii;
use app\components\BaseActiveRecord;

/**
 * This is the model class for table "product_price".
 *
 * @property int $id
 * @property string $title
 * @property int $product_id
 * @property int $min_quantity
 * @property int $max_quantity
 * @property string $price
 * @property int $state_id
 * @property int $type_id
 * @property string $created_on
 * @property string $updated_on
 * @property int $create_user_id
 *
 * @property User $createUser
 * @property Product $product
 * @property Product $product0
 * @property User $createUser0
 */
class ProductPrice extends BaseActiveRecord {
	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'product_price';
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [ 
				[ 
						[ 
								'title',
								'product_id',
								/* 'min_quantity',
								'max_quantity',
								'price', */
								'create_user_id' 
						],
						'required' 
				],
				[ 
						[ 
								'product_id',
								'min_quantity',
								'max_quantity',
								'state_id',
								'type_id',
								'create_user_id' 
						],
						'integer' 
				],
				[ 
						[ 
								'created_on',
								'updated_on' 
						],
						'safe' 
				],
				[ 
						[ 
								'title',
								'price' 
						],
						'string',
						'max' => 255 
				],
				[ 
						[ 
								'create_user_id' 
						],
						'exist',
						'skipOnError' => true,
						'targetClass' => User::className (),
						'targetAttribute' => [ 
								'create_user_id' => 'id' 
						] 
				],
				[ 
						[ 
								'product_id' 
						],
						'exist',
						'skipOnError' => true,
						'targetClass' => Product::className (),
						'targetAttribute' => [ 
								'product_id' => 'id' 
						] 
				],
				[ 
						[ 
								'product_id' 
						],
						'exist',
						'skipOnError' => true,
						'targetClass' => Product::className (),
						'targetAttribute' => [ 
								'product_id' => 'id' 
						] 
				],
				[ 
						[ 
								'create_user_id' 
						],
						'exist',
						'skipOnError' => true,
						'targetClass' => User::className (),
						'targetAttribute' => [ 
								'create_user_id' => 'id' 
						] 
				] 
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [ 
				'id' => Yii::t ( 'app', 'ID' ),
				'title' => Yii::t ( 'app', 'Title' ),
				'product_id' => Yii::t ( 'app', 'Product ID' ),
				'min_quantity' => Yii::t ( 'app', 'Min Quantity' ),
				'max_quantity' => Yii::t ( 'app', 'Max Quantity' ),
				'price' => Yii::t ( 'app', 'Price' ),
				'state_id' => Yii::t ( 'app', 'State ID' ),
				'type_id' => Yii::t ( 'app', 'Type ID' ),
				'created_on' => Yii::t ( 'app', 'Created On' ),
				'updated_on' => Yii::t ( 'app', 'Updated On' ),
				'create_user_id' => Yii::t ( 'app', 'Create User ID' ) 
		];
	}
	public function beforeValidate() {
		if ($this->isNewRecord) {
			
			if (empty ( $this->created_on ))
				$this->created_on = date ( "Y-m-d H:i:s" );
			if (empty ( $this->create_user_id = \yii::$app->user->id ))
				$this->create_user_id = \yii::$app->user->id;
		} else {
			$this->updated_on = date ( "Y-m-d H:i:s" );
		}
		
		return parent::beforeValidate ();
	}
	
	/**
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getCreateUser() {
		return $this->hasOne ( User::className (), [ 
				'id' => 'create_user_id' 
		] );
	}
	
	/**
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getProduct() {
		return $this->hasOne ( Product::className (), [ 
				'id' => 'product_id' 
		] );
	}
	
	/**
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getProduct0() {
		return $this->hasOne ( Product::className (), [ 
				'id' => 'product_id' 
		] );
	}
	
	/**
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getCreateUser0() {
		return $this->hasOne ( User::className (), [ 
				'id' => 'create_user_id' 
		] );
	}
}
