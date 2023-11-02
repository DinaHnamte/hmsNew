<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;


$this->params['breadcrumbs'][] = ['label' => 'Admin', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Approved Tenant';

?>
<h4>Health Service Providers</h4>

<?php 
  
  $url1 = array(
    'url' => 'tenant-view',
    'label' => 'Remove',
    'options' => array(
        'title' => 'Remove Health Service Provider',
        'class' => 'showModalButton'
    )
);
    
?>
<?php Pjax::begin(['id' => 'tenant-index']); ?>
  <?= common\widgets\tenants\TenantIndex::widget(['dataProvider'=> $dataProvider,
      'actionUrl1' => json_encode($url1),
  ]) ?>
<?php Pjax::end(); ?>
    