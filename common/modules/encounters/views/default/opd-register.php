<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\OpdReg;
use app\models\auth\RegUser;
use yii\bootstrap4\Button;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap5\Tabs;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = $this->context->module->encounterType .' Counter';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="opd-index">

<?php $this->beginBlock('OpdRegister'); ?>
    <center>
        <?= common\widgets\SearchBox::widget([
            'targetId'=> 'opd-patient-list', 'placeholder' => 'Enter E-mail'
        ]) ?> 
    </center> 

   
<?php Pjax::begin(['id' => 'register-patient']); ?>
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
              'value' => function ($data) {
                  return \Yii::$app->formatter->asDatetime($data->registered_at, 'php:Y-m-d H:i:s');
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
<?php Pjax::end(); ?>
<?php $this->endBlock(); ?>

<?php echo Tabs::widget([
    'items' => [
        [
            'label' => 'Active Patients',
            'url' => Url::to(['index']),            
        ],
        [
            'label' => 'Awaiting Consultation',
            'url' => Url::to(['await-consult']),
        ],
        [
            'label' => 'OPD Register',
            'content' => $this->blocks['OpdRegister'], 
            'active' => true
        ],
        [
            'label' => 'Register Patient',          
            'url' => Url::to(['register-patient']),             
        ],       
    ],
]);?>


</div>

