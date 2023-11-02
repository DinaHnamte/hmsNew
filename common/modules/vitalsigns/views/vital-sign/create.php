<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\PcsCodes $model */

$this->title = 'Record Vital Sign';
$this->params['breadcrumbs'][] = ['label' => 'Pcs Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vitalsign-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

<?php Pjax::begin(['id' => 'vital-signs']); ?>
    <?=  
        $this->renderAjax('get-vital-signs', [
            'dataProvider' => $dataProvider,
        ]); ?>
<?php Pjax::end(); ?>
</div>
