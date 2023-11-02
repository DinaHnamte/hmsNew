<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Dept;
use common\models\EmployeeDept;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Patient Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="opd-index">
  <h3>OPD COUNTER</h3>
  <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ref_dept')->dropDownList(ArrayHelper::map(Dept::find()->
        where(['tenant_id' => $model->hsp_id])->all(), 'id', 'name'),['prompt'=>'Select'])
        ->label('Department') ?>
    <?= $form->field($model, 'dr_id')->dropDownList(
        ArrayHelper::map($doctors, 'id', 'name'),['prompt'=>'Select'])->label('Doctor') ?>
    <?= $form->field($model, 'reg_fee')->textInput(['type' => 'number']) ?>
        
    <div class="container d-flex align-items-center justify-content-center mt-3 mb-2">
        <?= Html::button('Done', ['class' => 'btn btn-success postFormAjax', 'pjaxTarget' => 'opd-patient-pjax']) ?>
    </div>
  <?php ActiveForm::end(); ?>

</div>


    