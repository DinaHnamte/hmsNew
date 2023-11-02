<?php
use yii\grid\GridView;
?>


<h1>Sections</h1>
<div>
  <?= GridView::widget([
      'id' => 'section-grid',
      'summary' => '',
      'dataProvider' => $dataProvider,
      'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label' => "Name",
            'attribute' => 'name'
        ],
        [
            'label'=>'Type',
            'attribute'=>'type',				    
        ],
      ],
    ]);?>
</div>