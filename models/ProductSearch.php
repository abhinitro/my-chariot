<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form of `app\models\Product`.
 */
class ProductSearch extends Product
{

    public $brand, $category, $subCategory;

    /**
     *
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'id',
                    
                    'state_id',
                    'type_id',
                    'create_user_id'
                ],
                'integer'
            ],
            [
                [
                    'title',
                    'category_id',
                    'sub_category_id',
                    'brand_id',
                    'part_number',
                    'amount',
                    'description',
                    'created_on',
                    'updated_on',
                    'category',
                    'subCategory',
                    'brand'
                ],
                'safe'
            ]
        ];
    }

    /**
     *
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function beforeValidate()
    {
        return true;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find()->alias('p');
        
        // add conditions that should always apply here
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        
        $this->load($params);
        
        if (! $this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        // grid filtering conditions
        $query->andFilterWhere([
            'p.id' => $this->id,
            'p.state_id' => $this->state_id,
            'p.type_id' => $this->type_id,
            'p.created_on' => $this->created_on,
            'p.updated_on' => $this->updated_on
        ]);
        
        if (! empty($this->category_id)) {
            $query->joinWith('category as c');
            $query->andFilterWhere([
                'like',
                'c.title',
                $this->category_id
            ]);
        }
        
        if (! empty($this->sub_category_id)) {
            $query->joinWith('subCategory as s');
            $query->andFilterWhere([
                'like',
                's.title',
                $this->sub_category_id
            ]);
        }
        
        if (! empty($this->brand_id)) {
            $query->joinWith('brand as b');
            $query->andFilterWhere([
                'like',
                'b.title',
                $this->brand_id
            ]);
        }
        
        $query->andFilterWhere([
            'like',
            'p.title',
            $this->title
        ])
            ->andFilterWhere([
            'like',
            'p.part_number',
            $this->part_number
        ])
            ->andFilterWhere([
            'like',
            'p.amount',
            $this->amount
        ])
            ->andFilterWhere([
            'like',
            'p.description',
            $this->description
        ]);
        
        return $dataProvider;
    }

    public function searchProduct($params)
    {
        $query = Product::find()->alias('p')
            ->joinWith('category as c')
            ->joinWith('subCategory as sc')
            ->joinWith('brand as b');
        
        if (isset($params['brand_id'])) {
            $arr = explode(',', $params['brand_id']);
            $query->andFilterWhere([
                'p.brand_id' => $arr
            ]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        
        $query->andFilterWhere([
            'like',
            'c.slug',
            isset($params['category']) ? $params['category'] : ''
        ])->andFilterWhere([
            'like',
            'sc.slug',
            isset($params['subCategory']) ? $params['subCategory'] : ''
        ]);
        
        if (isset($params['title'])) {
            $query->orFilterWhere([
                'like',
                'c.title',
                $params['title']
            ])
                ->orFilterWhere([
                'like',
                'p.title',
                $params['title']
            ])
                ->orFilterWhere([
                'like',
                'sc.title',
                $params['title']
            ])
                ->orFilterWhere([
                'like',
                'b.title',
                $params['title']
            ]);
        }
        
        if (isset($params['deal'])) {
            $query->joinWith('deal as d')->andFilterWhere([
                'like',
                'd.slug',
                $params['deal']
            ]);
        }
        if (isset($params['banner'])) {
            $query->joinWith('banner as bnr')->andFilterWhere([
                'like',
                'bnr.slug',
                $params['banner']
            ]);
        }
        if (isset($params['partNumber'])) {
            $query->andFilterWhere([
                'p.part_number' => $params['partNumber']
            ]);
        }
        
        if (isset($params['sortBy'])) {
            if ($params['sortBy'] == 'new') {
                $query->orderBy([
                    'p.id' => 'ASC'
                ]);
            } elseif ($params['sortBy'] == 'price') {
                $query->orderBy([
                    'p.amount' => 'DESC'
                ]);
            } elseif ($params['sortBy'] == 'rate') {
                $query->joinWith('rating as r');
            }
        }
        
        return $dataProvider;
    }

    public function getBrandId($params)
    {
        $query = Product::find()->alias('p')
            ->select([
            'p.brand_id',
            'b.title'
        ])
            ->joinWith('category as c')
            ->joinWith('subCategory as sc')
            ->joinWith('brand as b');
        
        $query->andFilterWhere([
            'like',
            'c.slug',
            isset($params['category']) ? $params['category'] : ''
        ])
            ->andFilterWhere([
            'like',
            'sc.slug',
            isset($params['subCategory']) ? $params['subCategory'] : ''
        ])
            ->andFilterWhere([
            'like',
            'b.slug',
            isset($params['brand']) ? $params['brand'] : ''
        ]);
        
        if (isset($params['deal'])) {
            $query->joinWith('deal as d')->andFilterWhere([
                'like',
                'd.slug',
                $params['deal']
            ]);
        }
        
        return $query->distinct()->all();
    }

    public function getSubCategoryID($params)
    {
        $catregory = null;
        $models = null;
        if (isset($params['category'])) {
            $catregory = Category::findOne([
                'slug' => $params['category']
            ]);
        }
        
        if (! empty($params['subCategory']) && $catregory != null) {
            
            $subcate = SubCategory::find()->where([
                'slug' => $params['subCategory']
            ])->one();
            
            $models = SubCategory::find()->select([
                'id',
                'title',
                'category_id',
                'sub_category_id'
            ])
                ->where([
                'category_id' => $catregory->id,
                'sub_category_id' => $subcate->id
            ])
                ->all();
            
            return $models;
        }
        
        if (! empty($params['category'])) {
            $models = SubCategory::find()->select([
                'id',
                'title',
                'category_id',
                'sub_category_id'
            ])
                ->where([
                'category_id' => $catregory->id,
                'sub_category_id' => 0
            ])
                ->all();
        }
        
        return $models;
    }

    public function searchProductWithCat($params)
    {
        $query = Product::find()->alias('p')
            ->joinWith('category as c')
            ->joinWith('subCategory as sc')
            ->joinWith('brand as b')
            ->where([
            'p.state_id' => Product::STATE_ACTIVE
        ]);
        if (isset($params['brand_id'])) {
            $arr = explode(',', $params['brand_id']);
            $query->andFilterWhere([
                'p.brand_id' => $arr
            ]);
        }
        if (isset($params['sortBy'])) {
            // var_dump($params);exit;
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'sort' => [
                    'defaultOrder' => [
                        $params['sortBy'] => SORT_DESC
                    ]
                ]
            ]);
        } else {
            $dataProvider = new ActiveDataProvider([
                'query' => $query
            ]);
        }
        if (isset($params['sub_cat_cat_id'])) {
            $arr = explode(',', $params['sub_cat_cat_id']);
            
            $query->andFilterWhere([
                'p.sub_category_id' => $arr
            ]);
        } else {
            $query->andFilterWhere([
                'like',
                'c.slug',
                isset($params['category']) ? $params['category'] : ''
            ])->andFilterWhere([
                'like',
                'sc.slug',
                isset($params['subCategory']) ? $params['subCategory'] : ''
            ]);
        }
        
        if (isset($params['deal'])) {
            $query->joinWith('deal as d')->andFilterWhere([
                'like',
                'd.slug',
                $params['deal']
            ]);
        }
        if (isset($params['partNumber'])) {
            $query->andFilterWhere([
                'p.part_number' => $params['partNumber']
            ]);
        }
        // var_dump($query->createCommand()->getRawSql());exit();
        return $dataProvider;
    }
}
