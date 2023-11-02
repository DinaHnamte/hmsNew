<?php

use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ArrayDataProvider */
/* @var $searchModel \yii2mod\rbac\models\search\AuthItemSearch */

$this->params['breadcrumbs'][] = ['label' => 'Admin', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Application Roles';

?>
<div class="item-index">
    <h1><?php echo Html::encode($this->title); ?></h1>
    <p>
        <?= Html::a('Create Role', ['create-role'], ['value' => Url::to(['create-role']),
                    'title' => 'Application Roles', 'class' => 'btn btn-success showModalButton']) ?>
    </p>
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

