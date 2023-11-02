<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\Dept;
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
<?php $this->beginBlock('AwaitConsult'); ?>
<center>
<div class="opd-reg-index mt-2">
    <?= Html::dropDownList('dept_id','',ArrayHelper::map($depts, 'id', 'name'),
	         [  'id' => 'dept_id',
                'prompt'=>'-Select Dept-',
                'onchange'=>'
                $.pjax({
                    url: "'.Url::to(['await-consult']).'",
                    type: "POST",
                    container: "#await-consult-list",
                    data: {dept_id: $(this).val()},
                })
            ']); ?>
</div>
<?= common\widgets\SearchTable::widget([
        'tableId'=> 'opd-patient-list', 'columnIndex' => 1, 'placeholder' => 'Enter keyword'
    ]) ?> 
</center>
<?php Pjax::begin(['id' => 'await-consult-list']); ?> 
<div class="opd-reg-index">
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
            'content' => $this->blocks['AwaitConsult'],
            'active' => true
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

