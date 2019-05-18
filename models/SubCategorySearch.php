<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SubCategory;

/**
 * SubCategorySearch represents the model behind the search form of `app\models\SubCategory`.
 */
class SubCategorySearch extends SubCategory
{

    /**
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
                    'created_on',
                    'updated_on',
                    'create_user_id'
                ],
                'integer'
            ],
            [
                [
                    'title',
                    'category_id',
                    'description'
                ],
                'safe'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    
    
    public function beforeValidate(){
        //to search 
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
        $query = SubCategory::find()->alias('s');
        
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
            's.id' => $this->id,
           
            's.state_id' => $this->state_id,
            's.type_id' => $this->type_id,
            's.created_on' => $this->created_on,
            's.updated_on' => $this->updated_on,
           
        ]);
        if(!empty($this->category_id))
        {
            $query->joinWith('category as c');
            $query->andFilterWhere([
                'like',
                'c.title',
                $this->category_id
            ]);
        }
        $query->andFilterWhere([
            'like',
            's.title',
            $this->title
        ])->andFilterWhere([
            'like',
            's.description',
            $this->description
        ]);
        
        return $dataProvider;
    }
}
