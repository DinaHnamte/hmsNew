<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Assign Roles';
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sessiondtl-index">
	
    <h4><?= Html::encode('Assign Roles to : '. $regUser->name) ?></h4>
		
		<?= GridView::widget([
        'dataProvider' => $dataProvider,
		'summary' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'app.name',
			[
				'label'=>'Role Name',
				'format'=>'raw',
				'attribute' => 'role_id',
				'value' => function($data){					
						return $data->name;
				}
			],
					
            [
				'label'=>'Name',
				'format'=>'raw',
				'value' => function($data){					
					return Html::a('Assign', ['assign-user-role', 'user_id' => Yii::$app->request->get('user_id')], [
						'data-confirm' => 'Are you sure you want to Assign this role to the user?',
						'data-method' => 'POST',
						'data-params' => [
							'id' => $data->id,
							'user_id' => Yii::$app->request->get('user_id'),
						],
					]); 	 
				}
			],
        ],
    ]); ?>

</div>
