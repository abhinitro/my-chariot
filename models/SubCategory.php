<?php
namespace app\models;

use app\modules\media\models\Media;
use Yii;
use app\components\BaseActiveRecord;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "sub_category".
 *
 * @property int $id
 * @property string $title
 * @property int $category_id
 * @property string $description
 * @property int $state_id
 * @property int $type_id
 * @property int $created_on
 * @property int $updated_on
 * @property int $create_user_id
 *
 * @property Product[] $products
 * @property Product[] $products0
 * @property Category $category
 * @property User $createUser
 * @property User $createUser0
 * @property Category $category0
 */
class SubCategory extends BaseActiveRecord
{

    public $keywords;

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
    public static function tableName()
    {
        return 'sub_category';
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
                    'category_id',
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
                    'category_id',
                    'sub_category_id',
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
                    'slug',
                    'keywords'
                ],
                'safe'
            ],
            [
                [
                    'description'
                ],
                'string'
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
                    'category_id'
                ],
                'exist',
                'skipOnError' => true,
                'targetClass' => Category::className(),
                'targetAttribute' => [
                    'category_id' => 'id'
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
        Product::deleteRelatedAll([
            'sub_category_id' => $this->id
        
        ]);
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
            'category_id' => Yii::t('app', 'Category'),
            'sub_category_id' => Yii::t('app', 'Sub Category'),
            'description' => Yii::t('app', 'Description'),
            'state_id' => Yii::t('app', 'State'),
            'type_id' => Yii::t('app', 'Type'),
            'created_on' => Yii::t('app', 'Created On'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'create_user_id' => Yii::t('app', 'Create User')
        ];
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), [
            'sub_category_id' => 'id'
        ]);
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), [
            'id' => 'category_id'
        ]);
    }

    public function getSubCategory()
    {
        return $this->hasOne(SubCategory::className(), [
            'id' => 'sub_category_id'
        ]);
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

    public function getsubCategories($model)
    {
        $models = self::find()->where([
            'category_id' => $model->category_id,
            'sub_category_id' => $model->id
        ])->all();
        
        return $models;
    }
}