<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Order;

/**
 * OrderSearch represents the model behind the search form of `app\models\Order`.
 */
class OrderSearch extends Order {
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
								'amount',
								'discount',
								'code',
								'vat',
								'tax',
								'full_name',
								'address',
								'latitude',
								'longitude',
								'url',
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
	
	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params        	
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params) {
		$query = Order::find ();
		
		// add conditions that should always apply here
		
		$dataProvider = new ActiveDataProvider ( [ 
				'query' => $query 
		] );
		
		if (! $this->load ( $params )) {
			
			return $dataProvider;
		}
		
		if (! $this->validate ()) {
			
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}
		
		// grid filtering conditions
		$query->andFilterWhere ( [ 
				'id' => $this->id,
				'state_id' => $this->state_id,
				'type_id' => $this->type_id 
		]
		 );
		
		$query->andFilterWhere ( [ 
				'like',
				'amount',
				$this->amount 
		] )->andFilterWhere ( [ 
				'like',
				'discount',
				$this->discount 
		] )->andFilterWhere ( [ 
				'like',
				'code',
				$this->code 
		] )->andFilterWhere ( [ 
				'like',
				'vat',
				$this->vat 
		] )->andFilterWhere ( [ 
				'like',
				'tax',
				$this->tax 
		] )->andFilterWhere ( [ 
				'like',
				'full_name',
				$this->full_name 
		] )->andFilterWhere ( [ 
				'like',
				'address',
				$this->address 
		] )->andFilterWhere ( [ 
				'like',
				'latitude',
				$this->latitude 
		] )->andFilterWhere ( [ 
				'like',
				'longitude',
				$this->longitude 
		] )->andFilterWhere ( [ 
				'like',
				'url',
				$this->url 
		] );
		// echo $query->createCommand()->rawSql;exit;
		
		return $dataProvider;
	}
}
