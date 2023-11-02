<?php

use yii\helpers\Html;
use common\widgets\tenants\SelectHsp;

/** @var yii\web\View $this */
/** @var app\models\OpdReg $model */


?>
<div class="opd-reg-update">

<p> 
   <h3><?= Html::encode('Select Hospital/Clinic') ?></h3>
</p>

<?= SelectHsp::widget(['dataProvider'=> $dataProvider]) ?>

</div>
