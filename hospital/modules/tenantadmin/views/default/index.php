<?php

use app\models\User;
use yii\helpers\Html;
/** @var yii\web\View $this */

$this->title = 'Admin';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">

        <p>
            <?= Html::a('Employees', ["usersnroles/"],
                ['class' => 'btn btn-outline-secondary']) ?>
        </p> 
        
        <p>
            <?= Html::a('Departments', ["dept/"],
                ['class' => 'btn btn-outline-secondary']) ?>
        </p>

        <p>
            <?= Html::a('Doctor', ["default/get-doctors"],
                ['class' => 'btn btn-outline-secondary']) ?>
        </p>

    </div>
    
</div>
