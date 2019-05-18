<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Wishlist;

/**
 * WishlistSearch represents the model behind the search form of `app\models\Wishlist`.
 */
class WishlistSearch extends Wishlist
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'type_id', 'state_id', 'create_user_id'], 'integer'],
            [['created_on', 'update_on'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
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
        $query = Wishlist::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'product_id' => $this->product_id,
            'type_id' => $this->type_id,
            'state_id' => $this->state_id,
            'created_on' => $this->created_on,
            'update_on' => $this->update_on,
            'create_user_id' => $this->create_user_id,
        ]);

        return $dataProvider;
    }
}
