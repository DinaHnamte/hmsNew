<?php

/** @var yii\web\View $this */
/** @var string $content */

use admin\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<main role="main">
    <div class="container">
        <?= $content ?>
    </div>
</main>

<?php $this->endBody() ?>
</body>
</html>
<?php
	yii\bootstrap5\Modal::begin([		
        'headerOptions' => ['id' => 'modalHeader'],
		'id' => 'modal',
		'size' => 'modal-lg',
		//keeps from closing modal with esc key or by clicking out of the modal.
		// user must click cancel or X to close
		'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
	]);
	echo "<div id='modalContent'></div>";
	echo "<div class='modal-footer'></div>";
	yii\bootstrap5\Modal::end();
?>
<?php $this->endPage();
