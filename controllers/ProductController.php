<?php
namespace app\controllers;

use app\components\BaseController;
use app\modules\media\models\Media;
use app\models\Product;
use app\models\ProductSearch;
use app\models\SubCategory;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use app\models\ProductPrice;
use app\models\Keyword;
use app\models\Review;
use app\models\Wishlist;
use app\models\Category;
use app\models\Brand;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends BaseController
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
                'rules' => [
                    [
                        'actions' => [
                            'bulk-delete',
                            'index',
                            'view',
                            'create',
                            'image-update',
                            'delete',
                            'update',
                            'delete-price',
                            'subcategory',
                            'import'
                        ],
                        'allow' => true,
                        'matchCallback' => function () {
                            return User::isAdmin() || User::isManager();
                        }
                    ],
                    [
                        'actions' => [
                            'list',
                            'detail',
                            'deal',
                            'search-by-part-number',
                            'get-search'
                        ],
                        'allow' => true,
                        'roles' => [
                            '*',
                            '@',
                            '?'
                        ]
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => [
                        'POST'
                    ]
                ]
            ]
        ];
    }

    public function actionDeletePrice($id)
    {
        \Yii::$app->response->format = 'json';
        $model = ProductPrice::findOne($id);
        
        if ($model) {
            $model->delete();
        }
        return [
            'status' => 200
        ];
    }

    public function actionList($category = null, $subCategory = null, $brand = null, $deal = null, $part_number = null, $brand_id = [], $sub_cat_cat_id = [], $flag = false, $sortBy = null)
    {
        $params = Yii::$app->request->queryParams;
        
        $model = new ProductSearch();
        if ($flag == true) {
            $dataProvider = $model->searchProductWithCat(\Yii::$app->request->get());
            \Yii::$app->response->format = 'json';
            $response['status'] = 'OK';
            $response['res'] = $this->renderPartial('_product-list', [
                'dataProvider' => $dataProvider
            ], true);
            return $response;
        }
        $dataProvider = $model->searchProduct(\Yii::$app->request->queryParams);
        $brands = $model->getBrandId(\Yii::$app->request->get());
        $subCategory = $model->getSubCategoryID(\Yii::$app->request->get());
        
        return $this->render('list', [
            'dataProvider' => $dataProvider,
            'brands' => $brands,
            'sub_categories' => $subCategory
        ]);
    }

    public function actionGetSearch($category = null, $subCategory = null, $brand = null, $deal = null, $part_number = null, $brand_id = [], $sub_cat_cat_id = [], $sortBy = null)
    {
        $model = new ProductSearch();
        
        $dataProvider = $model->searchProductWithCat(\Yii::$app->request->get());
        
        // var_dump($_POST);exit;
        \Yii::$app->response->format = 'json';
        // $response ['status'] = 'NOK';
        $arr = [];
        foreach ($_POST['model'] as $mode) {
            $arr[] = $mode;
        }
        // $query=Product::find()->where(['sub_category_id'=>$arr]);
        // $dataProvider = new ActiveDataProvider ( [
        // 'query' => $query
        // ] );
        
        $response['status'] = 'OK';
        $response['res'] = $this->renderPartial('_product-list', [
            'dataProvider' => $dataProvider
        ], true);
        
        // echo CJSON::encode($response);
        return $response;
    }

    public function actionSortBy($dataProvider, $filed)
    {
        $dataProvider->sort->defaultOrder = [
            $filed => SORT_ASC
        ];
        \Yii::$app->response->format = 'json';
        // $response ['status'] = 'NOK';
        
        // $query=Product::find()->where(['sub_category_id'=>$arr]);
        // $dataProvider = new ActiveDataProvider ( [
        // 'query' => $query
        // ] );
        
        $response['status'] = 'OK';
        $response['res'] = $this->renderPartial('_product-list', [
            'dataProvider' => $dataProvider
        ], true);
        
        // echo CJSON::encode($response);
        return $response;
    }

    public function actionDetail($slug = null)
    {
        $model = Product::findOne([
            'slug' => $slug
        ]);
        
        if (empty($model)) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
        $review = new Review();
        $wishlist = new Wishlist();
        
        $getReview = Review::find()->where([
            'product_id' => $model->id
        ]);
        $reviewDataProvider = new ActiveDataProvider([
            'query' => $getReview
        ]);
        $product = Product::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $product,
            'pagination' => [
                'pageSize' => 4
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_on' => SORT_DESC
                ]
            ]
        ]);
        return $this->render('detail', [
            'model' => $model,
            'review' => $review,
            'reviewDataProvider' => $reviewDataProvider,
            'wishlist' => $wishlist,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionDeal($id)
    {
        $query = Product::find()->where([
            'deal_id' => $id
        ])->andWhere([
            'state_id' => Product::STATE_ACTIVE
        ]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        return $this->render('list', [
            
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Lists all Product models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionImageUpdate($id)
    {
        \Yii::$app->response->format = 'json';
        $response['status'] = 'NOK';
        
        $media = Media::find()->where([
            'id' => $id
        ])->one();
        if (! empty($media)) {
            
            $imageFile = UploadedFile::getInstance($media, 'file_name');
            
            if (! empty($imageFile)) {
                $fileName = $imageFile->baseName . '_' . time() . '.' . $imageFile->extension;
                $imageFile->saveAs(UPLOAD_PATH . '/' . $fileName);
                $media->size = $imageFile->size;
                $media->extension = $imageFile->extension;
                $media->file_name = $fileName;
                $media->original_name = $imageFile->baseName;
                if ($media->save()) {
                    $response['status'] = 'OK';
                }
            }
            return $response;
        }
    }

    public function actionGetSubCategory($id)
    {
        \Yii::$app->response->format = 'json';
        $response['status'] = 'NOK';
        
        $models = SubCategory::find()->where([
            'category_id' => $id
        ])->all();
        if (! empty($models)) {
            foreach ($models as $model) {
                $response['data'] = $model;
                $response['status'] = 'OK';
            }
        }
        return $response;
    }

    /**
     * Displays a single Product model.
     *
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id)
        ]);
    }

    public function actionSubcategory($id)
    {
        \Yii::$app->response->format = 'json';
        $response = [];
        $sub = SubCategory::find()->where([
            'category_id' => $id,
            'state_id' => SubCategory::STATE_ACTIVE
        ])->all();
        if ($sub) {
            $response = [
                'result' => yii\helpers\ArrayHelper::map($sub, 'id', 'title')
            ];
        }
        return $response;
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
    	
        $model = new Product();
        $media = new Media([
            'scenario' => 'add'
        ]);
        
        $list = [];
        $productPrice = new ProductPrice();
        $db = \yii::$app->db;
        $post = Yii::$app->request->post();
        $transaction = $db->beginTransaction();
        try {
            if ($model->load(Yii::$app->request->post())) {
                if (! empty($_POST['Product']['package']) && ! empty($_POST['Product']['package_quantity'])) {
                    foreach ($_POST['Product']['package'] as $key => $package) {
                        $data['package'] = $package;
                        $data['quantity'] = $_POST['Product']['package'][$key];
                        $list[] = $data;
                    }
                    
                    if (! empty($list)) {
                        $model->package_detail = json_encode($list);
                    }
                }
                
                $subCategory = SubCategory::find()->where([
                    'id' => $model->sub_category_id
                ])->one();
                // if (! empty($subCategory)) {
                // $model->category_id = $subCategory->category_id;
                // }
                
                if (! empty($model->product_ids) && (is_array($model->product_ids))) {
                    $model->product_ids = implode(',', $model->product_ids);
                }
                
                if ($model->save()) {
                    
                    if ($media->saveMultipleFile($media, $model, 'file_name')) {
                        if (! empty($post['ProductPrice']['min_quantity']) && ! empty($post['ProductPrice']['max_quantity']) && ! empty($post['ProductPrice']['price'])) {
                            foreach ($post['ProductPrice']['min_quantity'] as $key => $minQuantity) {
                                if (! empty($minQuantity) && ! empty($post['ProductPrice']['max_quantity'][$key]) && ! empty($post['ProductPrice']['price'][$key])) {
                                    $price = new ProductPrice();
                                    $price->product_id = $model->id;
                                    $price->min_quantity = $minQuantity;
                                    $price->title = $model->title;
                                    $price->max_quantity = $post['ProductPrice']['max_quantity'][$key];
                                    $price->price = $post['ProductPrice']['price'][$key];
                                    
                                    if (! empty($model->keywords)) {
                                        foreach ($model->keywords as $keyword) {
                                            $keyModel = new Keyword();
                                            $keyModel->title = $keyword;
                                            $keyModel->model_id = $model->id;
                                            $keyModel->model_type = get_class($model);
                                            $keyModel->save();
                                        }
                                    }
                                    
                                    if (! $price->save()) {
                                        \yii::$app->session->setFlash('danger', \yii::t('app', $price->errorString()));
                                        return $this->render('create', [
                                            'model' => $model,
                                            'media' => $media,
                                            'productPrice' => $productPrice
                                        ]);
                                    }
                                }
                            }
                        }
                        $transaction->commit();
                        return $this->redirect([
                            'view',
                            'id' => $model->id
                        ]);
                    } else {
                        \yii::$app->session->setFlash('danger', \yii::t('app', "File Not Uploaded"));
                    }
                } else {
                    \yii::$app->session->setFlash('danger', $model->errorString());
                }
            }
        } catch (\Exception $e) {
            $transaction->rollback();
            \yii::$app->session->setFlash('danger', $e->getMessage());
        }
        
        return $this->render('create', [
            'model' => $model,
            'media' => $media,
            'productPrice' => $productPrice
        ]);
    }

    public function actionImport()
    {
        $model = new Media();
        
        if (isset($_FILES) && (! empty($_FILES))) {
            
            $csvFile = UploadedFile::getInstance($model, 'file_name');
            
            $zipFile = UploadedFile::getInstance($model, 'zip_file');
            
            if (! empty($csvFile)) {
                $time = time();
                
                $fileName = $csvFile->baseName . '-' . $time;
                
                $csvFile->saveAs(UPLOAD_PATH . '/' . $fileName);
                $model->file_name = UPLOAD_PATH . '/' . $fileName;
                
                if (! empty($zipFile)) {
                    $zipFileName = $zipFile->baseName . '-' . $time . '.zip';
                    $zipFile->saveAs(UPLOAD_PATH . '/' . $zipFileName);
                    
                    if (file_exists(UPLOAD_PATH . '/' . $zipFileName)) {
                        
                        $zip = new \ZipArchive();
                        $res = $zip->open(UPLOAD_PATH . '/' . $zipFileName);
                        if ($res === TRUE) {
                            $zip->extractTo(UPLOAD_PATH);
                            $zip->close();
                        }
                    }
                }
                
                $handle = fopen($model->file_name, "r");
                $row = 1;
                while (($fileop = fgetcsv($handle, 1000, ",")) !== false) {
                    
                    if ($row == 1) {
                        $row ++;
                        continue;
                    }
                    $category = Category::find()->where([
                        'title' => $fileop[0]
                    ])->one();
                    if (empty($category)) {
                        $category = new Category();
                        
                        $category->title = $fileop[0];
                        $category->description = $fileop[1];
                        $category->keywords = $fileop[3];
                        if (! $category->save()) {
                            \yii::$app->session->setFlash('danger', \yii::t('app', $category->errorString()));
                            
                            return $this->render('import', [
                                'model' => $model
                            ]);
                        } // 2 for cAtegory image
                    }
                    $model->getZipFile($zipFile->baseName, $fileop[2], $category, $fileop[4]);
                    
                    $subCategoryArray = explode(',', $fileop[5]);
                    if (empty($subCategoryArray[0])) {
                        $subTitle = $fileop[5];
                        $subId = 0;
                    } else {
                        $subTitle = $subCategoryArray[0];
                        $subId = isset($subCategoryArray[1]) ? $subCategoryArray[1] : '';
                    }
                    $subCategory = SubCategory::find()->where([
                        'title' => $subTitle
                    ])->one();
                    if (empty($subCategory)) {
                        $subCategory = new SubCategory();
                        
                        $subCategory->category_id = $category->id;
                        $subCategory->title = $subTitle;
                        $subCategory->description = $fileop[6];
                        $subParentId = $subId;
                        
                        $parentModel = SubCategory::find()->where([
                            'title' => $subParentId
                        ])->one();
                        if (! empty($parentModel)) {
                            
                            $subCategory->sub_category_id = $parentModel->id;
                        }
                        
                        $subCategory->keywords = $fileop[8];
                        if (! $subCategory->save()) {
                            \yii::$app->session->setFlash('danger', \yii::t('app', $subCategory->errorString()));
                            
                            return $this->render('import', [
                                'model' => $model
                            ]);
                        }
                    }
                    $model->getZipFile($zipFile->baseName, $fileop[7], $subCategory, $fileop[9]);
                    // 7 for sub cAtegory image
                    
                    $brand = Brand::find()->where([
                        'title' => $fileop[10]
                    ])->one();
                    if (empty($brand)) {
                        $brand = new Brand();
                        $brand->title = $fileop[10];
                        $brand->description = $fileop[11];
                        $brand->keywords = $fileop[13];
                        if (! $brand->save()) {
                            \yii::$app->session->setFlash('danger', \yii::t('app', $brand->errorString()));
                            
                            return $this->render('import', [
                                'model' => $model
                            ]);
                        }
                    }
                    $model->getZipFile($zipFile->baseName, $fileop[12], $brand, $fileop[14]);
                    $product = Product::find()->where([
                        'title' => $fileop[15],
                        'category_id' => $category->id,
                        'sub_category_id' => $subCategory->id
                    ])->one();
                    if (empty($product)) {
                        $product = new Product();
                        
                        $product->category_id = $category->id;
                        $product->sub_category_id = $subCategory->id;
                        $product->brand_id = $brand->id;
                        $product->title = $fileop[15];
                        $product->description = $fileop[16];
                        $product->keywords = $fileop[18];
                        $product->youtube_link = $fileop[20];
                        $product->part_number = $fileop[21];
                        $product->discount = $fileop[22];
                        $product->amount = $fileop[23];
                        $product->create_user_id = \yii::$app->user->id;
                        if (! $product->save(false)) {
                            \yii::$app->session->setFlash('danger', \yii::t('app', $product->errorString()));
                            
                            return $this->render('import', [
                                'model' => $model
                            ]);
                        }
                        
                        if (! empty($fileop[24]) && ! empty($fileop[25]) && ! empty($fileop[26])) {
                            $productPrice = ProductPrice::find()->where([
                                'product_id' => $product->id,
                                'min_quantity' => $fileop[24],
                                'max_quantity' => $fileop[25],
                                'price' => $fileop[26]
                            ])->one();
                            if (empty($productPrice)) {
                                
                                $productPrice = new ProductPrice();
                                $productPrice->title = $product->title;
                                $productPrice->product_id = $product->id;
                                
                                $productPrice->min_quantity = $fileop[24];
                                $productPrice->max_quantity = $fileop[25];
                                $productPrice->price = $fileop[26];
                                if (! $productPrice->save()) {
                                    \yii::$app->session->setFlash('danger', \yii::t('app', $productPrice->errorString()));
                                    
                                    return $this->render('import', [
                                        'model' => $model
                                    ]);
                                }
                            }
                        }
                    }
                    
                    $model->getMultipleZipFile($zipFile->baseName, $fileop[17], $product, $fileop[19]);
                }
            }
        }
        return $this->render('import', [
            'model' => $model
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $media = Media::find()->where([
            'model_id' => $model->id,
            'model_type' => get_class($model)
        ])->one();
        $oldFile = '';
        if (empty($media)) {
            $media = new Media();
        } else {
            $oldFile = $media->file_name;
        }
        
        $post = Yii::$app->request->post();
        if ($model->load(Yii::$app->request->post())) {
            if (! empty($model->product_ids) && (is_array($model->product_ids))) {
                $model->product_ids = implode(',', $model->product_ids);
            }
            
            if (! empty($_POST['Product']['package']) && ! empty($_POST['Product']['package_quantity'])) {
                foreach ($_POST['Product']['package'] as $key => $package) {
                    $data['package'] = $package;
                    $data['quantity'] = $_POST['Product']['package'][$key];
                    $list[] = $data;
                }
                
                if (! empty($list)) {
                    $model->package_detail = json_encode($list);
                }
            }
            if ($model->save()) {
                
                ProductPrice::deleteRelatedAll([
                    'product_id' => $model->id
                ]);
                
                $media->saveMultipleFile($media, $model, 'file_name');
                
                if (! empty($post['ProductPrice']['min_quantity']) && ! empty($post['ProductPrice']['max_quantity']) && ! empty($post['ProductPrice']['price'])) {
                    
                    foreach ($post['ProductPrice']['min_quantity'] as $key => $minQuantity) {
                        if (! empty($minQuantity) && ! empty($post['ProductPrice']['max_quantity'][$key]) && ! empty($post['ProductPrice']['price'][$key])) {
                            $price = new ProductPrice();
                            $price->product_id = $model->id;
                            $price->min_quantity = $minQuantity;
                            $price->title = $model->title;
                            $price->max_quantity = $post['ProductPrice']['max_quantity'][$key];
                            $price->price = $post['ProductPrice']['price'][$key];
                            
                            if (! $price->save()) {
                                \yii::$app->session->setFlash('danger', \yii::t('app', $price->errorString()));
                                
                                return $this->render('update', [
                                    'model' => $model,
                                    'media' => $media
                                ]);
                            }
                        }
                    }
                }
            }
            
            return $this->redirect([
                'view',
                'id' => $model->id
            ]);
        }
        if (! empty($model->product_ids) && (is_string($model->product_ids))) {
            $model->product_ids = explode(',', $model->product_ids);
        }
        return $this->render('update', [
            'model' => $model,
            'media' => $media
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        
        return $this->redirect([
            'index'
        ]);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }
        
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
