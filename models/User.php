<?php

namespace app\models;

use Yii;
use app\components\BaseActiveRecord;
use yii\web\IdentityInterface;
use yii\helpers\Html;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends BaseActiveRecord implements IdentityInterface {
	public $confirm_password;
	public $newPassword;
	
	/**
	 * @inheritdoc
	 */
	const ROLE_ADMIN = 0;
	const ROLE_MANAGER = 1;
	const ROLE_USER = 4;
	const STATE_INACTIVE = 0;
	const STATE_ACTIVE = 1;
	const STATE_DELETED = 2;
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
		return 'user';
	}
	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [ 
				[ 
						[ 
								//'username',
								'auth_key',
								'password',
								'email',
								'status',
								//'full_name',
								'role_id',
								'created_on',
								'updated_on' 
						],
						'required' 
				],
				
				[ 
						
						[ 
								'email',
								'password',
								'confirm_password' 
						],
						'required',
						'on' => [ 
								'add-admin' 
						] 
				],
				
				[ 
						[ 
								//'username',
								'password',
								'confirm_password',
								'email',
								'contact_no',
								
								//'full_name' 
						
						],
						'required',
						'on' => [ 
								'add-admin',
								'add-user' 
						] 
				],
				
				[ 
						[ 
								'username',
								'email',
								'full_name' 
						
						],
						'required',
						'on' => [ 
								'update' 
						] 
				],
				
				[ 
						'password',
						'compare',
						'compareAttribute' => 'confirm_password',
						'on' => [ 
								'add-admin',
								'add-user' 
						] 
				],
				
				[ 
						'newPassword',
						'compare',
						'compareAttribute' => 'confirm_password',
						'on' => [ 
								'changepassword' 
						] 
				],
				
				[ 
						[ 
								'status',
								'role_id',
								 
						],
						'integer' 
				],
				[ 
						[ 
								'username',
								'password',
								'confirm_password' 
							// 'access-token'
						],
						'string',
						'max' => 255 
				],
				[ 
						[ 
								'auth_key' 
						],
						'string',
						'max' => 32 
				],
				[ 
						[ 
								'email' 
						],
						'string',
						'max' => 100 
				],
				[ 
						[ 
								'last_login' 
						],
						'required',
						'on' => 'last-login' 
				],
				
				[ 
						[ 
								'newPassword',
								'confirm_password' 
						
						],
						'required',
						'on' => 'changepassword' 
				],
				
				// [
				// ['profile_image'],
				// 'file',
				// 'extension' => 'png,jpg'
				// ],
				[ 
						[ 
								'contact_us',
								'contact_no',
								'last_login',
								'address',
								'latitude',
								'longituge',
								'profile_image' 
						],
						'safe' 
				] 
		];
	}
	public function scenarios() {
		$scenarios = parent::scenarios ();
		$scenarios ['add-admin'] = [ 
				'email',
				'username',
				
				'full_name',
				'password',
				'confirm_password' 
		];
		$scenarios ['last-login'] = [ 
				'last_login' 
		];
		
		$scenarios ['add-user'] = [ 
				'email',
				'username',
				'full_name',
				'contact_no',
				'password',
				'confirm_password',
				'profile_image' 
		];
		
		$scenarios ['update'] = [ 
				'email',
				'username',
				'full_name',
				'profile_image' 
		];
		
		$scenarios ['social'] = [ 
				'email',
				'username',
				'full_name',
				'profile_image',
				'role_id' 
		];
		
		$scenarios ['changepassword'] = [ 
				'newPassword',
				'confirm_password' 
		];
		
		return $scenarios;
	}
	public function beforeValidate() {
		if ($this->isNewRecord) {
			if (isset ( $this->created_on ))
				$this->created_on = date ( "Y-m-d H:i:s" );
		} else {
			if (!isset ( $this->updated_on ))
				$this->updated_on = date ( "Y-m-d H:i:s" );
				if (!isset ( $this->created_on ))
					$this->created_on = date ( "Y-m-d H:i:s" );
					if (!isset ( $this->auth_key ))
						$this->auth_key= '0';
		}
		
		return parent::beforeValidate ();
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [ 
				'id' => Yii::t ( 'app', 'ID' ),
				'username' => Yii::t ( 'app', 'Username' ),
				'auth_key' => Yii::t ( 'app', 'Auth Key' ),
				'password' => Yii::t ( 'app', 'Password' ),
				'email' => Yii::t ( 'app', 'Email' ),
				'status' => Yii::t ( 'app', 'Status' ),
				'state_id' => Yii::t ( 'app', 'Status' ),
				'role_id' => Yii::t ( 'app', 'Role' ),
				'created_on' => Yii::t ( 'app', 'Created' ),
				'updated_on' => Yii::t ( 'app', 'Updated' ) 
		];
	}
	public static function findIdentity($id) {
		return static::findOne ( $id );
	}
	public function setPassword() {
		$this->password = Yii::$app->getSecurity ()->generatePasswordHash ( $this->password );
	}
	
	/**
	 * @inheritdoc
	 */
	public static function findIdentityByAccessToken($token, $type = null) {
		return static::findOne ( [ 
				'access_token' => $token 
		] );
	}
	
	/**
	 * Finds user by username
	 *
	 * @param string $username        	
	 * @return static|null
	 */
	public static function findByUsername($username, $flag) {
		if ($flag) {
			return static::findOne ( [ 
					'email' => $username,
					'role_id' => User::ROLE_ADMIN 
			] );
		} else {
			return static::findOne ( [ 
					'email' => $username,
					'role_id' => User::ROLE_USER 
			] );
		}
	}
	
	/**
	 * @inheritdoc
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * @inheritdoc
	 */
	public function getAuthKey() {
		return $this->auth_key;
	}
	
	/**
	 * @inheritdoc
	 */
	public function validateAuthKey($authKey) {
		return $this->auth_key === $authKey;
	}
	
	/**
	 * Validates password
	 *
	 * @param string $password
	 *        	password to validate
	 * @return bool if password provided is valid for current user
	 */
	public function validatePassword($password) {
		return Yii::$app->getSecurity ()->validatePassword ( $password, $this->password );
	}
	public function profileImage($options = [], $default = "user.png") {
		if (! empty ( $this->profile_image ) && file_exists ( UPLOAD_PATH . '/' . $this->profile_image ) && ! is_dir ( UPLOAD_PATH . '/' . $this->profile_image )) {
			$file = [ 
					'/uploads/' . $this->profile_image 
			];
		} else {
			$file = \yii::$app->urlManager->createAbsoluteUrl ( 'themes/img/' . $default );
		}
		
		if (empty ( $options )) {
			$options = [ 
					'class' => 'img-responsive' 
			];
		}
		
		return Html::img ( $file, $options );
	}
	public static function isAdmin() {
		if (empty ( \Yii::$app->user->identity )) {
			return false;
		}
		return \Yii::$app->user->identity->role_id == self::ROLE_ADMIN;
	}
	public static function isManager() {
		if (empty ( \Yii::$app->user->identity )) {
			return false;
		}
		return \Yii::$app->user->identity->role_id == self::ROLE_MANAGER;
	}
	public static function isUser() {
		if (empty ( \Yii::$app->user->identity )) {
			return false;
		}
		return \Yii::$app->user->identity->role_id == self::ROLE_USER;
	}
}
