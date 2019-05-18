<?php

namespace app\models;

use app\modules\media\models\Media;
use Yii;
use app\components\BaseActiveRecord;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $state_id
 * @property int $type_id
 * @property int $created_on
 * @property int $updated_on
 * @property int $create_user_id
 *
 * @property User $createUser
 * @property User $createUser0
 * @property Product[] $products
 * @property Product[] $products0
 * @property SubCategory[] $subCategories
 * @property SubCategory[] $subCategories0
 */
class Category extends BaseActiveRecord {
	public $keywords;
	public function behaviors() {
		return [ 
				[ 
						'class' => SluggableBehavior::className (),
						'attribute' => 'title',
						'ensureUnique' => true,
						'slugAttribute' => 'slug' 
				] 
		];
	}
	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'category';
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [ 
				[ 
						[ 
								'title',
								'slug',
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
								'state_id',
								'type_id',
								'create_user_id' 
						],
						'integer' 
				],
				[ 
						[ 
								'created_on',
								'keywords',
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
	public function attributeLabels() {
		return [ 
				'id' => Yii::t ( 'app', 'ID' ),
				'title' => Yii::t ( 'app', 'Title' ),
				'description' => Yii::t ( 'app', 'Description' ),
				'state_id' => Yii::t ( 'app', 'State' ),
				'type_id' => Yii::t ( 'app', 'Type' ),
				'created_on' => Yii::t ( 'app', 'Created On' ),
				'updated_on' => Yii::t ( 'app', 'Updated On' ),
				'create_user_id' => Yii::t ( 'app', 'Create User' ) 
		];
	}
	public function beforeDelete() {
		SubCategory::deleteRelatedAll ( [ 
				'category_id' => $this->id 
		] );
		
		Product::deleteRelatedAll ( [ 
				'category_id' => $this->id 
		] );
		
		Media::deleteRelatedAll ( [ 
				'model_id' => $this->id,
				'model_type' => get_class ( $this ) 
		] );
		
		return parent::beforeDelete ();
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
	public function getProducts() {
		return $this->hasMany ( Product::className (), [ 
				'category_id' => 'id' 
		] );
	}
	
	/**
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getSubCategories() {
		return $this->hasMany ( SubCategory::className (), [ 
				'category_id' => 'id' 
		] );
	}
	public function getCategoryLIst($limit = null) {
		$category = self::find ()->select ( [ 
				'id',
				
				'title',
				'slug' 
		] );
		if (! empty ( $limit )) {
			$category = $category->limit ( $limit )->all ();
		} else {
			$category = $category->all ();
		}
		
		return $category;
	}
	public function getSubCategoriesList($id) {
		$models = SubCategory::find ()->where ( [ 
				'category_id' => $id,
				'sub_category_id' => 0 
		] )->all ();
		return $models;
	}
}
