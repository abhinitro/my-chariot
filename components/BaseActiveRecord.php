<?php
namespace app\components;

use app\modules\media\models\Media;
use app\models\User;
use Yii;
use yii\helpers\Html;
use yii\imagine\Image;
use yii\web\UploadedFile;

class BaseActiveRecord extends \yii\db\ActiveRecord
{

    const STATE_INACTIVE = 0;

    const STATE_ACTIVE = 1;

    const STATE_DELETED = 2;

    public function getStateOptions()
    {
        return [
            self::STATE_ACTIVE => \Yii::t('app', 'Active'),
            self::STATE_INACTIVE => \Yii::t('app', 'In Active'),
            self::STATE_DELETED => \Yii::t('app', 'Deleted')
        ];
    }

    public function getStateBadges()
    {
        $states = $this->getStateOptions();
        if ($this->state_id == self::STATE_ACTIVE) {
            return '<span class="label label-success">' . $states[self::STATE_ACTIVE] . '</span>';
        } elseif ($this->state_id == self::STATE_INACTIVE) {
            return '<span class="label label-default">' . $states[self::STATE_INACTIVE] . '</span>';
        } else if ($this->state_id == self::STATE_DELETED) {
            return '<span class="label label-danger">' . $states[self::STATE_DELETED] . '</span>';
        }
        return "Not Set";
    }

    public function beforeValidate()
    {
        return parent::beforeValidate();
    }

    public function getFile($model, $modelId = null, $type = null, $size = 'one')
    {
        if ($modelId !== null)
            $model_id = $modelId;
        else
            $model_id = $model->id;
        
        $media = Media::find()->where([
            'model_type' => get_class($model),
            'model_id' => $model_id
        ]);
        
        if ($type !== null) {
            $media = $media->andWhere([
                'type_id' => $type
            ]);
        }
        
        if ($size !== 'one')
            $media = $media->all();
        else
            $media = $media->one();
        
        return $media;
    }

    public function displayImage($model, $default = 'default.jpg', $options = [])
    {
        if (! empty($model) && file_exists(UPLOAD_PATH . '/' . $model->file_name) && ! is_dir(UPLOAD_PATH . '/' . $model->file_name)) {
            $file = [
                '/uploads/' . $model->file_name
            ];
        } else {
            $file = \yii::$app->urlManager->createAbsoluteUrl('themes/img/' . $default);
        }
        
        if (empty($options)) {
            $options = [
                'class' => 'img-responsive'
            ];
        }
        
        return Html::img($file, $options);
    }

    public function getImageFile($model, $default = 'default.jpg', $options = [], $attribute = 'file_name', $title = "Image")
    {
        $media = Media::find()->where([
            'model_id' => $model->id,
            'model_type' => get_class($model)
        ])->one();
        
        if (empty($options)) {
            $options = [
                'class' => 'img-responsive',
                'title' => $title
            ];
        }
        if (! empty($media)) {
            
            if ($attribute == 'thumb_file') {
                
                $fileDir = UPLOAD_PATH . '/' . 'thumbnail/' . $media->thumb_file;
                
                $filename = '/uploads/thumbnail/' . $media->thumb_file;
            } else {
                $fileDir = UPLOAD_PATH . '/' . $media->file_name;
                $filename = '/uploads/' . $media->file_name;
            }
            if (file_exists($fileDir) && ! is_dir($fileDir)) {
                $file = [
                    $filename
                ];
                
                return Html::img($file, $options);
            }
        }
        
        if (file_exists('themes/img/' . $default))
            
            $file = \yii::$app->urlManager->createAbsoluteUrl('themes/img/' . $default);
        else
            $file = \yii::$app->urlManager->createAbsoluteUrl('themes/frontend/img/' . $default);
        return Html::img($file, $options);
    }

    public function saveFile($media, $model, $attribute = 'file_name', $oldFile = null, $oldThumbFile = null)
    {
        $imageFile = UploadedFile::getInstance($media, 'file_name');
        if (! empty($imageFile)) {
            $thumbDir = UPLOAD_PATH . '/' . 'thumbnail/';
            if (! file_exists($thumbDir)) {
                mkdir($thumbDir, 0777, true);
            }
            $time = time();
            $fileName = $imageFile->baseName . '-' . $time . $imageFile->extension;
            $imageFile->saveAs(UPLOAD_PATH . '/' . $fileName);
            $originFile = UPLOAD_PATH . '/' . $fileName;
            $thumbnFile = $thumbDir . $imageFile->baseName . '_' . time() . '-thumb' . '_200x200' . '.' . $imageFile->extension;
            // Generate a thumbnail image
            Image::thumbnail($originFile, 200, 200)->save($thumbnFile, [
                'quality' => 80
            ]);
            $media->size = $imageFile->size;
            $media->extension = $imageFile->extension;
            $media->file_name = $fileName;
            $media->thumb_file = $imageFile->baseName . '_' . $time . '-thumb' . '_200x200' . '.' . $imageFile->extension;
            $media->original_name = $imageFile->baseName;
            $media->model_type = get_class($model);
            $media->model_id = $model->id;
            $media->title = isset($model->title) ? $model->title : 'Not set';
            
            if (! empty($oldFile) && file_exists(UPLOAD_PATH . '/' . $oldFile)) {
                unlink(UPLOAD_PATH . '/' . $oldFile);
            }
            if (! empty($oldThumbFile) && file_exists(UPLOAD_PATH . '/' . 'thumbnail/' . $oldThumbFile)) {
                unlink(UPLOAD_PATH . '/thumbnail/' . $oldThumbFile);
            }
        }
        if ($media->save()) {
            return true;
        }
        
        return false;
    }

    public function saveMultipleFile($media, $model, $attribute = 'file_name')
    {
        $imageFiles = UploadedFile::getInstances($media, 'file_name');
        
        if (! empty($imageFiles)) {
            foreach ($imageFiles as $imageFile) {
                $time = time();
                $fileName = $imageFile->baseName . '_' . time() . '.' . $imageFile->extension;
                $imageFile->saveAs(UPLOAD_PATH . '/' . $fileName);
                $thumbDir = UPLOAD_PATH . '/' . 'thumbnail/';
                if (! file_exists($thumbDir)) {
                    mkdir($thumbDir, 0777, true);
                }
                $originFile = UPLOAD_PATH . '/' . $fileName;
                $thumbnFile = $thumbDir . $imageFile->baseName . '_' . time() . '-thumb' . '_200x200' . '.' . $imageFile->extension;
                // Generate a thumbnail image
                Image::thumbnail($originFile, 200, 200)->save($thumbnFile, [
                    'quality' => 80
                ]);
                $media = new Media();
                $media->size = $imageFile->size;
                $media->extension = $imageFile->extension;
                $media->thumb_file = $imageFile->baseName . '_' . $time . '-thumb' . '_200x200' . '.' . $imageFile->extension;
                $media->file_name = $fileName;
                $media->original_name = $imageFile->baseName;
                $media->model_type = get_class($model);
                $media->model_id = $model->id;
                $media->title = isset($model->title) ? $model->title : 'Not set';
                if (! $media->save()) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }

    public function errorString()
    {
        $str = '';
        $errors = $this->errors;
        
        if (! empty($errors)) {
            foreach ($errors as $error) {
                $str .= $error['0'] . "</br>";
            }
        }
        return $str;
    }

    public static function deleteRelatedAll($query = null)
    {
        $models = self::find()->where($query)->all();
        if (! empty($models)) {
            foreach ($models as $model) {
                if ($model instanceof Media && file_exists(UPLOAD_PATH . '/' . $model->file_name)) {
                    unlink(UPLOAD_PATH . '/' . $model->file_name);
                }
                $model->delete();
            }
        }
    }

    public function getCreatedUser()
    {
        if (isset($this->create_user_id)) {
            $user = User::findOne($this->create_user_id);
            
            if (! empty($user)) {
                return Html::a($user->full_name, [
                    '/user/view',
                    'id' => $user->id
                ], [
                    'title' => $user->full_name
                ]);
            }
        }
        return "Not Set";
    }

    public function getParentTitle($relation, $url)
    {
        $funName = "get" . ucfirst($relation);
        if (method_exists($this, $funName)) {
            $model = $this->$funName()->one();
            if (! empty($model)) {
                return Html::a($model->title, [
                    "/$url/view",
                    'id' => $model->id
                ], [
                    'title' => $model->title
                ]);
            }
        }
        return "Not Set";
    }
}