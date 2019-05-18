<?php
namespace app\models;

use app\components\BaseActiveRecord;
use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "{{%page}}".
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
class Page extends BaseActiveRecord
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
     *
     * {@inheritdoc}
     *
     */
    const TYPE_PRIVACY = 1;

    const TYPE_ABOUT_US = 2;

    const TYPE_TERMS = 3;

    const TYPE_RETURN_REFUND = 4;

    const TYPE_SHIPPING = 5;

    const TYPE_GUARANTEE = 6;

    const STATE_INACTIVE = 0;

    const STATE_ACTIVE = 1;

    const STATE_DELETED = 2;

    public function getStateOptions()
    {
        return [
            self::STATE_ACTIVE => \Yii::t('app', 'Active'),
            self::STATE_INACTIVE => \Yii::t('app', 'In Active'),
            self::STATE_DELETED => \Yii::t('app', 'Deleted')
        ];
    }

    public static function gettypeOption()
    {
        return [
            self::TYPE_ABOUT_US => \Yii::t('app', 'About Us'),
            self::TYPE_PRIVACY => \Yii::t('app', 'Privacy'),
            self::TYPE_TERMS => \Yii::t('app', 'Terms and Condtion'),
            self::TYPE_RETURN_REFUND => \Yii::t('app', 'Free Return'),
            self::TYPE_SHIPPING => \Yii::t('app', 'Fast shipping'),
            self::TYPE_GUARANTEE => \Yii::t('app', '365 Day Guarantee')
        ];
    }

    public function getType()
    {
        $types = self::gettypeOption();
        
        return isset($types[$this->type_id]) ? $types[$this->type_id] : \Yii::t('app', 'Not select');
    }

    public function stateBadges()
    {
        $states = $this->getStateOption();
        if ($this->state_id == self::STATE_ACTIVE) {
            return '<span class="label label-success">' . $states[self::STATE_ACTIVE] . '</span>';
        } elseif ($this->state_id == self::STATE_INACTIVE) {
            return '<span class="label label-default">' . $states[self::STATE_INACTIVE] . '</span>';
        } else if ($this->state_id == self::STATE_DELETED) {
            return '<span class="label label-danger">' . $states[self::STATE_DELETED] . '</span>';
        }
    }

    public static function tableName()
    {
        return '{{%page}}';
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
     *
     * {@inheritdoc}
     *
     */
    public function rules()
    {
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
     *
     * {@inheritdoc}
     *
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'state_id' => Yii::t('app', 'State'),
            'type_id' => Yii::t('app', 'Type'),
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

    public function checkDefaultPages()
    {
        $types = self::gettypeOption();
        foreach ($types as $key => $type) {
            $model = self::find()->where([
                'type_id' => $key
            ])->count();
            if (empty($model)) {
                $model = new self();
                $model->title = $type;
                $model->state_id = self::STATE_ACTIVE;
                $model->description = "..";
                $model->type_id = $key;
                $model->save();
            }
        }
    }
}
