<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

if (! Yii::$app->user->isGuest) {
	
	app\assets\AppAsset::register ( $this );
	
	dmstr\web\AdminLteAsset::register ( $this );
	
	$directoryAsset = Yii::$app->assetManager->getPublishedUrl ( '@vendor/almasaeed2010/adminlte/dist' );
	
	?>
    <?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<meta charset="<?= Yii::$app->charset ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        
        <link rel="stylesheet" type="text/css"
	href="<?= \Yii::$app->view->theme->getUrl('/css/custom.css') ?>">
</head>
<body class="hold-transition skin-blue sidebar-mini"
	ng-app="Inkredibletoner">
	<span id="baseUrl" style="display: none;"
		data-url="<?= \Yii::$app->urlManager->createAbsoluteUrl('/') ?>"></span>
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?=$this->render ( 'header.php', [ 'directoryAsset' => $directoryAsset ] )?>

        <?=$this->render ( 'left.php', [ 'directoryAsset' => $directoryAsset ] )?>

        <?=$this->render ( 'content.php', [ 'content' => $content,'directoryAsset' => $directoryAsset ] )?>

    </div>
	<script
		src="<?= \Yii::$app->view->theme->getUrl('/js') ?>/admin-main.js"></script>
    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
<?php } ?>
