<?php

namespace app\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%wishlist}}".
 *
 * @property int $id
 * @property int $product_id
 * @property int $type_id
 * @property int $state_id
 * @property string $created_on
 * @property string $update_on
 * @property int $create_user_id
 */
class Wishlist extends \yii\db\ActiveRecord {
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public static function tableName() {
		return '{{%wishlist}}';
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
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
	public function rules() {
		return [ 
				[ 
						[ 
								'product_id',
								'type_id',
								'state_id',
								'create_user_id' 
						],
						'integer' 
				],
				[ 
						[ 
								'created_on',
								'update_on' 
						],
						'safe' 
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
				'type_id' => Yii::t ( 'app', 'Type ID' ),
				'state_id' => Yii::t ( 'app', 'State ID' ),
				'created_on' => Yii::t ( 'app', 'Created On' ),
				'update_on' => Yii::t ( 'app', 'Update On' ),
				'create_user_id' => Yii::t ( 'app', 'Created By ID' ) 
		];
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
	public function add_to_wishlist($model) {
		if (! \Yii::$app->user->id) {
			$var = '<a href="' . Url::toRoute ( [ '/user/login' 
			] ) . '" ';
		} else {
			// $var = '<a href="javascript:add_to_wishlist(' . $model->id . ')"';
			$var = '<a href="javascript:" id="add_to_wishlist_' . $model->id . '"   data-id="'.$model->id.'"   ';
		}
		$var .= 'class="main-btn icon-btn" title="'.\Yii::t('app', 'Add to Wishlist').'">';
		if (empty ( $model->getWishList () )) {
			$var .= '<i class="fa fa-heart-o" id="change-heart-class"></i>';
		} else {
			$var .= '<i class="fa fa-heart" id="change-heart-class"></i>';
		}
		$var .= '</a>';
		
		return $var;
	}
}
