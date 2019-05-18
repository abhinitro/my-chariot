<?php
namespace app\controllers;

use app\components\BaseController;
use app\models\ContactForm;
use app\models\Deal;
use app\models\Page;
use app\models\Product;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class SiteController extends BaseController
{

    /**
     *
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [
                    'logout'
                ],
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            'about',
                            'faq',
                            'contact',
                            'privacy-policy',
                            'support',
                            'term-condition',
                            'return-refund',
                            
                            'shipping',
                            'guarantee',
                            
                            'test'
                        ],
                        'allow' => true,
                        'roles' => [
                            '?',
                            '@',
                            '*'
                        ]
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => [
                        'post'
                    ]
                ]
            ]
        ];
    }

    /**
     *
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (User::isAdmin() || User::isManager()) {
            return $this->redirect([
                '/user/dashboard'
            ]);
        }
        $model = Product::find()->where(['state_id'=>Product::STATE_ACTIVE]);
        $dataProvider = new ActiveDataProvider([
            'query' => $model,
            'pagination' => [
                'pageSize' => 2
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_on' => SORT_DESC
                ]
            ]
        ]);
        
        $latestDataProvider = new ActiveDataProvider([
            'query' => $model,
            'pagination' => [
                'pageSize' => 12
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ]
        ]);
        
        $deals = Deal::find()->where([
            'state_id' => Deal::STATE_ACTIVE
        ]);
        
        $dealDataProvider = new ActiveDataProvider([
            'query' => $deals,
            'pagination' => [
                'pageSize' => 20
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_ASC
                ]
            ]
        ]);
        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'dealDataProvider' => $dealDataProvider,
            'latestDataProvider' => $latestDataProvider
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post())) {
            
            if ($model->contact(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('contactFormSubmitted');
                
                return $this->refresh();
            }
        }
        return $this->render('contact', [
            'model' => $model
        ]);
    }

    public function actionFaq()
    {
        $model = Page::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $model,
            'pagination' => [
                'pageSize' => 2
            ]
        ]);
        return $this->render('faq', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionTermCondition()
    {
        return $this->render('term-condition');
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionPrivacyPolicy()
    {
        return $this->render('privacy-policy');
    }

    public function actionReturnRefund()
    {
        return $this->render('refund');
    }

    public function actionShipping()
    {
        return $this->render('shipping');
    }

    public function actionGuarantee()
    {
        return $this->render('guarantee');
    }

    public function actionSupport($slug)
    {
        $model = Page::find()->where([
            'state_id' => Page::STATE_ACTIVE,
            'slug' => $slug
        ])->one();
        
        if (empty($model)) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
        return $this->render('support', [
            'model' => $model
        ]);
    }
}
