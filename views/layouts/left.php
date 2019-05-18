<aside class="main-sidebar">

	<section class="sidebar">

		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
                <?=\Yii::$app->user->identity->profileImage ( [ "class" => "img-circle","alt" => "User Image" ] )?>
            </div>
			<div class="pull-left info">
				<p><?= \Yii::$app->user->identity->full_name ?></p>
			</div>
		</div>


        <?php
        
        echo dmstr\widgets\Menu::widget([
            'options' => [
                'class' => 'sidebar-menu tree',
                'data-widget' => 'tree'
            ],
            'items' => [
                [
                    'label' => 'Menu',
                    'options' => [
                        'class' => 'header'
                    ]
                ],
                [
                    'label' => 'Users',
                    'icon' => 'users',
                    'url' => [
                        '/user'
                    ]
                ],
                [
                    'label' => 'Media',
                    'icon' => 'picture-o',
                    'url' => [
                        '/media/'
                    ]
                ],
                [
                    'label' => 'Banner',
                    'icon' => 'picture-o',
                    'url' => [
                        '/banner'
                    ]
                ],
                [
                    'label' => \yii::t('app', 'Product Details'),
                    'icon' => 'share',
                    'url' => '#',
                    'items' => [
                        [
                            'label' => \yii::t('app', 'Category'),
                            'icon' => 'server',
                            'url' => [
                                '/category'
                            ]
                        ],
                        [
                            'label' => \yii::t('app', 'SubCategory'),
                            'icon' => 'file-code-o',
                            'url' => [
                                '/sub-category'
                            ]
                        ],
                        [
                            'label' => \yii::t('app', 'Brands'),
                            'icon' => 'bold',
                            'url' => [
                                '/brand'
                            ]
                        ],
                        [
                            'label' => \yii::t('app', 'Deals'),
                            'icon' => 'handshake-o',
                            'url' => [
                                '/deal'
                            ]
                        ],
                        [
                            'label' => \yii::t('app', 'Products'),
                            'icon' => 'product-hunt',
                            'url' => [
                                '/product'
                            ]
                        ]
                    ]
                ],
                [
                    'label' => 'Coupons',
                    'icon' => 'ticket',
                    'url' => [
                        '/coupon'
                    ]
                ],
                [
                    'label' => \yii::t('app', 'Order'),
                    'icon' => 'gift',
                    'url' => '#',
                    'items' => [
                        [
                            'label' => \yii::t('app', 'Order'),
                            'icon' => 'first-order',
                            'url' => [
                                '/order'
                            ]
                        ]
                    
                    ]
                ],
                
                [
                    'label' => \yii::t('app', 'Page'),
                    'icon' => 'first-order',
                    'url' => [
                        '/page'
                    ]
                ]
            
            ]
        ])?>

    </section>

</aside>
