<?php

use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ArrayDataProvider */
/* @var $searchModel \yii2mod\rbac\models\search\AuthItemSearch */

$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['default/index']];
$this->params['breadcrumbs'][] = 'User Roles';

?>
<div class="item-index">
    <h4><?php echo Html::encode('User Roles'); ?></h4>
    
    <?php Pjax::begin(['id' => 'getroleslist']); ?>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'label' => 'Name',
            ],
            [
                'attribute' => 'app_id',
                'format' => 'ntext',
                'label' => 'App Id',
            ],
            [
                'attribute' => 'description',
                'format' => 'ntext',
                'label' => 'Description',
            ],
            [
                
                'class' => 'yii\grid\ActionColumn',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>

