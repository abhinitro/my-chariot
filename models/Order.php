<?php

namespace app\models;

use app\components\BaseActiveRecord;
use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $amount
 * @property string $discount
 * @property string $code
 * @property string $vat
 * @property string $tax
 * @property string $full_name
 * @property string $address
 * @property string $latitude
 * @property string $longitude
 * @property string $url
 * @property int $state_id
 * @property int $type_id
 * @property string $created_on
 * @property string $updated_on
 * @property int $create_user_id
 */
class Order extends BaseActiveRecord {
	const STATE_NEW = 0;
	public $firstName;
	public $lastName;
	public $mobile;
	
	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'order';
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [ 
				[ 
						[ 
								// 'full_name',
								'address',
								// 'code' ,
								'email' 
						],
						'required',
						'on' => 'checkout' 
				],
				
				[ 
						[ 
								'amount' 
						],
						'required' 
				],
				
				[ 
						[ 
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
								'city',
								'zip',
								'amount',
								'discount',
								'code',
								'vat',
								'tax',
								'full_name',
								'firstName',
								'lastName',
								'address',
								'latitude',
								'longitude',
								'email',
								'country'
						],
						'string',
						'max' => 255 
				],
				[ 
						[ 
								'url' 
						],
						'url' 
				] 
		
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
	public function getCreateUser() {
		return $this->hasOne ( User::className (), [ 
				'id' => 'create_user_id' 
		] );
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [ 
				'id' => Yii::t ( 'app', 'ID' ),
				'amount' => Yii::t ( 'app', 'Amount' ),
				'discount' => Yii::t ( 'app', 'Discount' ),
				'code' => Yii::t ( 'app', 'Code' ),
				'vat' => Yii::t ( 'app', 'Vat' ),
				'tax' => Yii::t ( 'app', 'Tax' ),
				'full_name' => Yii::t ( 'app', 'Full Name' ),
				'address' => Yii::t ( 'app', 'Address' ),
				'latitude' => Yii::t ( 'app', 'Latitude' ),
				'longitude' => Yii::t ( 'app', 'Longitude' ),
				'url' => Yii::t ( 'app', 'Url' ),
				'state_id' => Yii::t ( 'app', 'State ID' ),
				'type_id' => Yii::t ( 'app', 'Type ID' ),
				'created_on' => Yii::t ( 'app', 'Created On' ),
				'updated_on' => Yii::t ( 'app', 'Updated On' ),
				'create_user_id' => Yii::t ( 'app', 'Create User ID' ) 
		];
	}
	public function scenarios() {
		$scenarios = parent::scenarios ();
		
		$scenarios ['checkout'] = [ 
				'city',
				'zip',
				'amount',
				'discount',
				'code',
				'vat',
				'tax',
				'full_name',
				'firstName',
				'lastName',
				'address',
				'latitude',
				'longitude',
				'url',
				'email',
				'country'
		];
		
		return $scenarios;
	}
}
