<?php 
use yii\grid\GridView;
use yii\widgets\Pjax;
?>

<div id='disease-container'>
  <?php if($dataProvider != null): ?>
  <?php Pjax::begin(['id' => 'diseasesgrid']); ?>
  <?=GridView::widget([
    'id' => 'diseases-table',
    'summary' => '',
    'dataProvider' => $dataProvider,
    'columns' => [
      ['class' => 'yii\grid\SerialColumn'],
      [
        'label' => "Title",
        'attribute' => 'title'
      ],
      [
        'label'=>'ICD Code',
        'attribute'=>'icd_code',				    
      ],
    ],
    ]);
  ?>
  <?php Pjax::end(); ?>
  <?php endif; ?>
</div>
