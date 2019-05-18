<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%review}}".
 *
 * @property int $id
 * @property int $product_id
 * @property string $name
 * @property string $email
 * @property string $comments
 * @property double $ratings
 * @property string $created_on
 * @property string $update_on
 */
class Review extends \yii\db\ActiveRecord {
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public static function tableName() {
		return '{{%review}}';
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
								'name',
								'email',
								'comments',
								'ratings'
						],
						'required'
				],
				
				
				
				
				[ 
						[ 
								'product_id' 
						],
						'integer' 
				],
				[ 
						[ 
								'comments' 
						],
						'string' 
				],
				[ 
						[ 
								'ratings' 
						],
						'number' 
				],
				[ 
						[ 
								'created_on',
								'update_on' 
						],
						'safe' 
				],
				[ 
						[ 
								'name',
								'email' 
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
				'name' => Yii::t ( 'app', 'Name' ),
				'email' => Yii::t ( 'app', 'Email' ),
				'comments' => Yii::t ( 'app', 'Comments' ),
				'ratings' => Yii::t ( 'app', 'Ratings' ),
				'created_on' => Yii::t ( 'app', 'Created On' ),
				'update_on' => Yii::t ( 'app', 'Update On' ) 
		];
	}
	public function beforeValidate() {
		if ($this->isNewRecord) {
			
			if (empty ( $this->created_on ))
				$this->created_on = date ( "Y-m-d H:i:s" );
		} else {
			$this->updated_on = date ( "Y-m-d H:i:s" );
		}
		
		return parent::beforeValidate ();
	}
}
