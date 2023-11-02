<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

$this->params['breadcrumbs'][] = ['label' => 'Admin', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Approve HSP';

?>
<h4>Unapproved Health Service Providers</h4>

<?php 
  
  $url1 = array(
    'url' => 'approve-tenant-view',
    'label' => 'Approve',
    'options' => array(
        'title' => 'Approve Health Service Provider',
        'class' => 'showModalButton'
    )
);
     
?>
<?php Pjax::begin(['id' => 'approve-tenant-index']); ?>
  <?= common\widgets\tenants\TenantIndex::widget(['dataProvider'=> $dataProvider,
      'actionUrl1' => json_encode($url1),
  ]) ?>
<?php Pjax::end(); ?>
    