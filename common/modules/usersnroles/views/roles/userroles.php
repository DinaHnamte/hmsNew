<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Roles';
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sessiondtl-index">
	
    <h4><?= Html::encode('Roles assigned to : '. $regUser->name) ?></h4>
		
		<?= GridView::widget([
        'dataProvider' => $dataProvider,
		'summary' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'role.app.name',
			[
				'label'=>'Role Name',
				'format'=>'raw',
				'attribute' => 'role_id',
				'value' => function($data){
					return $data->role->name;
					// if($data->role!=null){
					// 	return $data->role->name;
					// }
					return ''; 
				}
			],
					
            [
				'label'=>'Name',
				'format'=>'raw',
				'value' => function($data){					
					return Html::a('Remove', ['userroles', 'user_id' => $data->user_id], [
						'data-confirm' => 'Are you sure you want to remove this role from the user?',
						'data-method' => 'POST',
						'data-params' => [
							'id' => $data->id,
							'user_id' => $data->user_id,
						],
					]); 	 
				}
			],
        ],
    ]); ?>

</div>
