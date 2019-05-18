<?php
namespace app\models;

use app\modules\media\models\Media;
use Yii;
use app\components\BaseActiveRecord;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $title
 * @property int $category_id
 * @property int $sub_category_id
 * @property int $brand_id
 * @property string $part_number
 * @property string $amount
 * @property string $description
 * @property int $state_id
 * @property int $type_id
 * @property string $created_on
 * @property string $updated_on
 * @property int $create_user_id
 *
 * @property Brand $brand
 * @property Category $category
 * @property User $createUser
 * @property SubCategory $subCategory
 * @property User $createUser0
 * @property Category $category0
 * @property SubCategory $subCategory0
 * @property Brand $brand0
 */
class Product extends BaseActiveRecord
{

    public $brand, $category, $subCategory, $keywords;

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
        return 'product';
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
                    'sub_category_id',
                    'brand_id',
                    'part_number',
                    'amount',
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
                    'brand_id',
                    'state_id',
                    'deal_id',
                    'banner_id',
                    'type_id',
                    'create_user_id'
                ],
                'integer'
            ],
            [
                [
                    'description'
                ],
                'string'
            ],
            [
                [
                    'created_on',
                    'updated_on',
                    'keywords',
                    'product_ids',
                    'youtube_link',
                    'package_detail'
                ],
                'safe'
            ],
            [
                [
                    'title',
                    'part_number'
                
                ],
                'string',
                'max' => 255
            ],
            [
                [
                    'amount',
                    'discount'
                
                ],
                'double'
            ],
            [
                [
                    'brand_id'
                ],
                'exist',
                'skipOnError' => true,
                'targetClass' => Brand::className(),
                'targetAttribute' => [
                    'brand_id' => 'id'
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
                    'sub_category_id'
                ],
                'exist',
                'skipOnError' => true,
                'targetClass' => SubCategory::className(),
                'targetAttribute' => [
                    'sub_category_id' => 'id'
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
        Media::deleteRelatedAll([
            'model_id' => $this->id,
            'model_type' => get_class($this)
        ]);
        
        ProductPrice::deleteRelatedAll([
            'product_id' => $this->id
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
            'brand_id' => Yii::t('app', 'Brand'),
            'part_number' => Yii::t('app', 'Product Number'),
            'product_ids' => Yii::t('app', 'Compatible Product'),
            'deal_id' => Yii::t('app', 'Deal'),
            'banner_id' => Yii::t('app', 'Banner'),
            'amount' => Yii::t('app', 'Amount'),
            'description' => Yii::t('app', 'Description'),
            'discount' => Yii::t('app', 'Discount (in %)'),
            'state_id' => Yii::t('app', 'State'),
            'type_id' => Yii::t('app', 'Type'),
            'created_on' => Yii::t('app', 'Created On'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'create_user_id' => Yii::t('app', 'Create User')
        ];
    }

    public function getWishList()
    {
        $wishList = Wishlist::findOne([
            'create_user_id' => \Yii::$app->user->id,
            'product_id' => $this->id
        ]);
        
        return $wishList;
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), [
            'id' => 'brand_id'
        ]);
    }

    public function getBrands()
    {
        return $this->hasOne(Brand::className(), [
            'id' => 'brand_id'
        ]);
    }

    public function getDeal()
    {
        return $this->hasOne(Deal::className(), [
            'id' => 'deal_id'
        ]);
    }

    public function getBanner()
    {
        return $this->hasOne(Banner::className(), [
            'id' => 'banner_id'
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

    public function getCategories()
    {
        return $this->hasOne(Category::className(), [
            'id' => 'category_id'
        ]);
    }

    public function getDiscountPrice()
    {
        $calcuate = $this->amount;
        
        if ((! empty($this->amount) && ! empty($this->discount))) {
            
            $discount_amount = ($this->amount * $this->discount) / 100;
            
            $calcuate = $this->amount - $discount_amount;
        }
        return $calcuate;
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

    public function getRating()
    {
        return $this->hasOne(Review::className(), [
            'id' => 'product_id'
        ]);
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategory()
    {
        return $this->hasOne(SubCategory::className(), [
            'id' => 'sub_category_id'
        ]);
    }

    public function getSubCategories()
    {
        return $this->hasOne(SubCategory::className(), [
            'id' => 'sub_category_id'
        ]);
    }

    public function getLatestProduct()
    {
        $models = Product::find()->where([
            'state_id' => Product::STATE_ACTIVE
        ])
            ->orderBy('id desc')
            ->limit('4')
            ->all();
        return $models;
    }

    public function getHotDeals($limit = null)
    {
        $models = Deal::find()->where([
            'state_id' => Deal::STATE_ACTIVE
        ]);
        
        if (! empty($limit)) {
            $models = $models->limit($limit)->all();
        } else {
            $models = $models->all();
        }
        return $models;
    }

    public function getBannerList($limit = null)
    {
        $models = Banner::find()->where([
            'state_id' => Deal::STATE_ACTIVE
        ]);
        
        if (! empty($limit)) {
            $models = $models->limit($limit)->all();
        } else {
            $models = $models->all();
        }
        return $models;
    }

    public function getTitleofBrand()
    {
        $model = Brand::find()->select('title')
            ->where([
            'id' => $this->brand_id
        ])
            ->one();
        if (! empty($model)) {
            return $model->title;
        } else {
            
            return '';
        }
    }
}
