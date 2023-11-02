<?php
use yii\helpers\Url;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this \yii\web\View */
/* @var $gridViewColumns array */
/* @var $dataProvider \yii\data\ArrayDataProvider */
/* @var $searchModel \yii2mod\rbac\models\search\AssignmentSearch */

?>
<div class="assignment-index">

    <h1><?php echo Html::encode($this->title); ?></h1>

    <?php Pjax::begin(['timeout' => 5000]); ?>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'user_id',
                'format' => 'ntext',
                'label' => 'ID',
            ],
            [
                'attribute' => 'name',
                'label' => 'Name',
            ],
            
            [
                
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                  'view' => function ($url, $model, $key) {
                      return Html::a('Assign',
                          Url::to(['assign-role','id' => $model->user_id]), [
                          'title' => 'View',
                      ]);
                  },
              ],
            ],
        ]
    ]); ?>

    <?php Pjax::end(); ?>
</div>