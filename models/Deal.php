<?php
namespace app\models;

use Yii;
use app\components\BaseActiveRecord;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "deal".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $state_id
 * @property int $type_id
 * @property string $created_on
 * @property string $updated_on
 * @property int $create_user_id
 *
 * @property User $createUser
 * @property User $createUser0
 */
class Deal extends BaseActiveRecord
{

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'ensureUnique' => true,
                'slugAttribute' => 'slug'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'deal';
    }

    public function beforeValidate()
    {
        if ($this->isNewRecord) {
            
            if (empty($this->created_on))
                $this->created_on = date("Y-m-d H:i:s");
            if (empty($this->create_user_id = \yii::$app->user->id))
                $this->create_user_id = \yii::$app->user->id;
        } else {
            $this->updated_on = date("Y-m-d H:i:s");
        }
        
        return parent::beforeValidate();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'title',
                    'slug',
                    'created_on',
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
                'targetClass' => User::className(),
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
                'targetClass' => User::className(),
                'targetAttribute' => [
                    'create_user_id' => 'id'
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'state_id' => Yii::t('app', 'Status'),
            'type_id' => Yii::t('app', 'Type ID'),
            'created_on' => Yii::t('app', 'Created On'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'create_user_id' => Yii::t('app', 'Create User ID')
        ];
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreateUser()
    {
        return $this->hasOne(User::className(), [
            'id' => 'create_user_id'
        ]);
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreateUser0()
    {
        return $this->hasOne(User::className(), [
            'id' => 'create_user_id'
        ]);
    }

    public function getOneDeal($ids = [])
    {
        if (empty($ids)) {
            return Deal::find()->where([
                'state_id' => self::STATE_ACTIVE
            ])->one();
        } else {
            return Deal::find()->where([
                'state_id' => self::STATE_ACTIVE
            ])
                ->andWhere([
                'not in',
                'id',
                $ids
            ])->one();
        }
    }

    public function getProductDeal($id)
    {
	    return Product::find()->where(['deal_id'=>$id])->limit(8)->all();
	}
}
