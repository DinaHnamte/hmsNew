<?php

use yii\helpers\Html;
use yii\helpers\Json;
use yii2mod\rbac\RbacAsset;

RbacAsset::register($this);

/* @var $this yii\web\View */
/* @var $model \yii2mod\rbac\models\AssignmentModel */
/* @var $usernameField string */

?>
<div class="assignment-index">

    <h1><?php echo Html::encode($user->name); ?></h1>

    <?php echo $this->render('../_duallist', [
        'opts' => Json::htmlEncode([
            'items' => $model->getItems(),
        ]),
        'assignUrl' => ['assign-roleitem', 'id' => $model->userId],
        'removeUrl' => ['remove-roleitem', 'id' => $model->userId],
        'done' => ['view-role', 'id' => Yii::$app->user->identity->id],
    ]); ?>

</div>
