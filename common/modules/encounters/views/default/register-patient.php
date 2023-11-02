<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\RegUser;
use yii\bootstrap4\Button;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap5\Tabs;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = $this->context->module->encounterType .' Counter';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="encounter-index">
<?php $this->beginBlock('RegisterPatient'); ?>
    <center>
        <?= common\widgets\SearchBox::widget([
            'targetId'=> 'register-patient', 'placeholder' => 'Enter E-mail'
        ]) ?> 
    </center> 

    <?php Pjax::begin(['id' => 'register-patient']); ?>
    <?= common\widgets\regusers\RegUserView::widget([
            'model'=> $regUserModel
        ]) ?> 
     
<div class="opd-reg-index">
    
<div class="encounter-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'encounter_type')->hiddenInput(['value' => $model->encounter_type])->label(false) ?>

    <?= $form->field($model, 'pat_id')->hiddenInput(['value' => $model->pat_id])->label(false) ?>

    <?= $form->field($model, 'hsp_id')->hiddenInput(['value' => $model->hsp_id])->label(false) ?>

    <?= $form->field($model, 'chief_complaint')->textarea(['id' => 'chief_complaint', 'maxlength' => true]) ?>

    <div class="form-group container d-flex align-items-center justify-content-center mt-4 mb-4" >
        <?= Html::button('Register', ['class' => 'btn btn-success postFormAjax',
         'targetId' => 'targetid']) ?>
    </div>

    <?php ActiveForm::end(); ?>

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
            'url' => Url::to(['opd-register']),
        ],
        [
            'label' => 'Register Patient',
            'content' => $this->blocks['RegisterPatient'], 
            'active' => true             
        ],       
    ],
]);?>

</div>

<center>
<div id="targetid" class="encounter-index ">
</div>
</center>

