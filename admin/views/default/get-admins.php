<?php

use yii\helpers\Html;
use yii\helpers\Json;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
// use yii2mod\rbac\RbacAsset;

// RbacAsset::register($this);

/* @var $this yii\web\View */
/* @var $model \yii2mod\rbac\models\AssignmentModel */
/* @var $usernameField string */
    $this->params['breadcrumbs'][] = ['label' => 'Admin', 'url' => ['index']];
    $this->params['breadcrumbs'][] = 'App Admins';
?>
<div class="app-admin-index">

<h4><?= Html::encode($this->title) ?></h4>


<?= Html::a('Add Admin',
        ['create-admin'], ['value' => Url::to(['create-admin']), 'title' => 'Add Admin User', 
        'class' => 'btn btn-success showModalButton']);
?>
<?php Pjax::begin(['id' => 'reguser-list' ]); ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        
        'user.regUser.name',
        'user.username',
        //'item_name' ,
        [
            'label' => 'Action',
            'format' => 'raw',
            'value' => function ($data) {
                $url =Url::to(['remove-admin','user_id' => $data->user->id]) ;									
                return Html::a('Remove',
                 $url, ['value' => $url, 'title' => 'Remove Admin', 'class' => 'showModalButton']);
                
            }
         ],       
    ],
]); ?>
<?php Pjax::end(); ?>
</div>


