<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\OpdReg;
use app\models\RegUser;
use yii\bootstrap4\Button;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap5\Tabs;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Opd Counter';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="opd-index">



  <?php Pjax::begin(['id' => 'opd-patient-pjax']); ?>
  <?= $this->render('view', ['dataProvider' => $dataProvider]) ?>
  <?php Pjax::end(); ?>

</div>

