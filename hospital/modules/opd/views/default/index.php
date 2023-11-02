<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\OpdReg;
use app\models\RegUser;
use yii\bootstrap4\Button;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap5\Tabs;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Opd Counter';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="opd-index">

<h4>OPD Counter</h4>

<?php $this->beginBlock('ActivePatients'); ?>

<center>
    <?= common\widgets\SearchTable::widget([
        'tableId'=> 'opd-patient-list', 'columnIndex' => 1, 'placeholder' => 'Enter keyword'
    ]) ?> 
</center> 

<div class="opd-reg-index">
    <?= GridView::widget([
        'id' => 'opd-patient-list',
        'dataProvider' => $dataProvider,
        'summary' => '',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'pat_id',
            'regUser.name',
            'chief_complaint',
            [
              'attribute' => 'registered_at',
              'value' => function ($model) {
                  return \Yii::$app->formatter->asDatetime($model->registered_at, 'php:Y-m-d H:i:s');
              },
            ],
            [
              'label' => 'Record',
                'format' => 'raw',
                'value' => function ($data) {
                    $url =Url::to(['vitalsign/vital-sign/create','encounter_id' => $data->id]) ;

					          return Html::a('Vital Signs',
                    $url, ['value' => $url, 'title' => 'Record Vital Signs', 'class' => 'showModalButton']);
                  }
            ],
            [
              'label' => 'Action',
                'format' => 'raw',
                'value' => function ($data) {
                    $url =Url::to(['fee-payment','id' => $data->id]) ;

					          return Html::a('Select',
                    $url, ['value' => $url, 'title' => 'Register Patient for OPD', 'class' => 'showModalButton']);
                  }
            ],
        ],
    ]); ?>

</div>

<?php $this->endBlock(); ?>

<?php echo Tabs::widget([
    'items' => [
        [
            'label' => 'Active Patients',
            'content' => $this->blocks['ActivePatients'],
            'active' => true
        ],
        [
            'label' => 'OPD Register',
            'url' => Url::to(['opd-register']) ,
        ],
        [
            'label' => 'Example',
        ],        
    ],
]);?>

</div>

