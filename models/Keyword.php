<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "keyword".
 *
 * @property int $id
 * @property string $title
 * @property int $model_id
 * @property string $model_type
 * @property int $state_id
 * @property int $type_id
 * @property string $created_on
 * @property string $updated_on
 * @property int $create_user_id
 *
 * @property User $createUser
 * @property User $createUser0
 */
class Keyword extends \yii\db\ActiveRecord {
	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'keyword';
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
	 * @inheritdoc
	 */
	public function rules() {
		return [ 
				[ 
						[ 
								'title',
								'model_id',
								'model_type',
								'create_user_id' 
						],
						'required' 
				],
				[ 
						[ 
								'model_id',
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
								'title' 
						],
						'string',
						'max' => 255 
				],
				[ 
						[ 
								'model_type' 
						],
						'string',
						'max' => 125 
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
				'model_id' => Yii::t ( 'app', 'Model ID' ),
				'model_type' => Yii::t ( 'app', 'Model Type' ),
				'state_id' => Yii::t ( 'app', 'State ID' ),
				'type_id' => Yii::t ( 'app', 'Type ID' ),
				'created_on' => Yii::t ( 'app', 'Created On' ),
				'updated_on' => Yii::t ( 'app', 'Updated On' ),
				'create_user_id' => Yii::t ( 'app', 'Create User ID' ) 
		];
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
}
