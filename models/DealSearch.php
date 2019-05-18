<?php

namespace app\models;

use app\models\Deal;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * DealSearch represents the model behind the search form of `app\models\Deal`.
 */
class DealSearch extends Deal {
	/**
	 * @inheritdoc
	 */
	public function rules() {
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
								'description',
								'created_on',
								'updated_on' 
						],
						'safe' 
				] 
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function scenarios() {
		// bypass scenarios() implementation in the parent class
		return Model::scenarios ();
	}
	public function beforeValidate() {
		return true;
	}
	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params        	
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params) {
		$query = Deal::find ();
		
		// add conditions that should always apply here
		
		$dataProvider = new ActiveDataProvider ( [ 
				'query' => $query 
		] );
		
		$this->load ( $params );
		
		if (! $this->validate ()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}
		
		// grid filtering conditions
		$query->andFilterWhere ( [ 
				'id' => $this->id,
				'state_id' => $this->state_id,
				'type_id' => $this->type_id,
				'created_on' => $this->created_on,
				'updated_on' => $this->updated_on,
				'create_user_id' => $this->create_user_id 
		] );
		
		$query->andFilterWhere ( [ 
				'like',
				'title',
				$this->title 
		] )->andFilterWhere ( [ 
				'like',
				'description',
				$this->description 
		] );
		
		return $dataProvider;
	}
}
