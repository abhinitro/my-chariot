<?php

namespace app\models;

use app\components\BaseActiveRecord;
use Yii;

/**
 * This is the model class for table "coupon".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $code
 * @property string $discount
 * @property string $max_discount
 * @property int $max_use
 * @property int $state_id
 * @property int $type_id
 * @property string $created_on
 * @property string $updated_on
 * @property int $create_user_id
 *
 * @property User $createUser
 * @property User $createUser0
 * @property UserCoupon[] $userCoupons
 * @property UserCoupon[] $userCoupons0
 */
class Coupon extends BaseActiveRecord {
	const STATE_ACTIVE = 1;
	const STATE_INACTIVE = 2;
	const STATE_DELETED = 3;
	
	/**
	 * @inheritdoc
	 */
	public function getStateOption() {
		return [ 
				self::STATE_ACTIVE => \Yii::t ( 'app', 'Active' ),
				self::STATE_INACTIVE => \Yii::t ( 'app', 'In Active' ),
				self::STATE_DELETED => \Yii::t ( 'app', 'Deleted' ) 
		];
	}
	public function stateBadges() {
		$states = $this->getStateOption ();
		if ($this->state_id == self::STATE_ACTIVE) {
			return '<span class="label label-success">' . $states [self::STATE_ACTIVE] . '</span>';
		} elseif ($this->state_id == self::STATE_INACTIVE) {
			return '<span class="label label-default">' . $states [self::STATE_INACTIVE] . '</span>';
		} else if ($this->state_id == self::STATE_DELETED) {
			return '<span class="label label-danger">' . $states [self::STATE_DELETED] . '</span>';
		}
	}
	public static function tableName() {
		return 'coupon';
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [ 
				[ 
						[ 
								'title',
								'code',
								'discount',
								'max_discount',
								'create_user_id' 
						],
						'required' 
				],
				[ 
						[ 
								'title' 
						],
						'unique' 
				],
				[ 
						[ 
								'description' 
						],
						'string' 
				],
				[ 
						[ 
								'max_use',
								'state_id',
								'type_id',
								'create_user_id' 
						],
						'integer' 
				],
				[ 
						[ 
								'created_on',
								'updated_on',
								'start_date',
								'end_date' 
						],
						'safe' 
				],
				[ 
						[ 
								'title',
								'code',
								'discount',
								'max_discount' 
						],
						'string',
						'max' => 255 
				],
				// ['end_date','compare','compareAttribute'=>'start_date','operator'=>'>', 'message'=>'{attribute} must be greater than "{compareValue}".'],
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
				'description' => Yii::t ( 'app', 'Description' ),
				'code' => Yii::t ( 'app', 'Code' ),
				'discount' => Yii::t ( 'app', 'Discount' ),
				'max_discount' => Yii::t ( 'app', 'Max Discount' ),
				'max_use' => Yii::t ( 'app', 'Max Use' ),
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
	public function getCreateUser0() {
		return $this->hasOne ( User::className (), [ 
				'id' => 'create_user_id' 
		] );
	}
	
	/**
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getUserCoupons() {
		return $this->hasMany ( UserCoupon::className (), [ 
				'coupon_id' => 'id' 
		] );
	}
	
	/**
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getUserCoupons0() {
		return $this->hasMany ( UserCoupon::className (), [ 
				'coupon_id' => 'id' 
		] );
	}
}
