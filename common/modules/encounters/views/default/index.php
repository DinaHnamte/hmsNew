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

$this->title = $this->context->module->encounterType .' Counter';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="encounter-index">
<?php $this->beginBlock('ActivePatient'); ?>
    <center>
        <?= common\widgets\SearchTable::widget([
            'tableId'=> 'opd-patient-list', 'columnIndex' => 1, 'placeholder' => 'Enter keyword'
        ]) ?> 
    </center> 

<div class="opd-reg-index">
<?php Pjax::begin(['id' => 'active-patient']); ?>
    <?= GridView::widget([
        'id' => 'opd-patient-list',
        'dataProvider' => $dataProvider,
        'summary' => '',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label'=>'Name',
                'attribute'=>'pat_id',
                'value' => 'regUser.name',
              ],
              [
                'label'=>'Compliant',
                'attribute'=>'pat_id',
                'value' => 'chief_complaint',
              ],
              [
                'label'=>'Address',
                'attribute'=>'pat_id',
                'value' => 'regUser.add1',
              ],
              [
                'label'=>'Phone',
                'attribute'=>'pat_id',
                'value' => 'regUser.mobno',
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
<?php Pjax::end(); ?>
</div>

<?php $this->endBlock(); ?>

<?php echo Tabs::widget([
    'items' => [
        [
            'label' => 'Active Patients',
            'content' => $this->blocks['ActivePatient'],
            'active' => true
        ],
        [
            'label' => 'Awaiting Consultation',
            'url' => Url::to(['await-consult']),
        ],
        [
            'label' => 'OPD Register',          
            'url' => Url::to(['opd-register']), 
            
        ],  
        [
            'label' => 'Register Patient',          
            'url' => Url::to(['register-patient']), 
            
        ],    
    ],
]);?>

</div>

