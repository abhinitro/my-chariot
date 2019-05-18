<?php
namespace app\models;

use Yii;
use app\components\BaseActiveRecord;
use yii\behaviors\SluggableBehavior;
use app\modules\media\models\Media;

/**
 * This is the model class for table "banner".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
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
class Banner extends BaseActiveRecord
{

    /**
     *
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banner';
    }

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
                    'title',
                    'slug'
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

    public function beforeDelete()
    {
//         BannerProduct::deleteRelatedAll([
//             'banner_id' => $this->id
//         ]);
        Media::deleteRelatedAll([
            'model_id' => $this->id,
            'model_type' => get_class($this)
        ]);
        
        return parent::beforeDelete();
    }

    /**
     *
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'slug' => Yii::t('app', 'Slug'),
            'description' => Yii::t('app', 'Description'),
            'state_id' => Yii::t('app', 'State ID'),
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
}
