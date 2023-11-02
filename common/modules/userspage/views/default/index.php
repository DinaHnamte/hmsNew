<?php

/** @var yii\web\View $this */
use yii\bootstrap4\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
             
                
        <p>
            <?= Html::a('My Profile', ["myprofile", 'id' => Yii::$app->user->identity->id],
                ['class' => 'btn btn-outline-secondary']) ?>
        </p>
        <p>
            <?= Html::a('My Diagnosis/ICD10', ["utils/myicd10/index"],
                ['class' => 'btn btn-outline-secondary']) ?>
        </p>
        <p>
            <?= Html::a('My Medicines', ["utils/my-medicine/index"],
                ['class' => 'btn btn-outline-secondary']) ?>
        </p>
        <p>
            <?= Html::a('Register Hospital/Clinic', ["create-tenant", 'id' => Yii::$app->user->identity->id],
                ['class' => 'btn btn-success']) ?>
        </p>
        <p>
        <?php echo Html::beginForm(['site/logout'], 'post', ['class' => 'd-flex'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout text-decoration-none']
            )
            . Html::endForm();
        ?>
        </P>
        <p>
        <?php echo Html::beginForm(['site/logout'], 'post', ['class' => 'd-flex'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-outline-secondary']
            )
            . Html::endForm();
        ?>
        </P>
    </div>
        
    
</div>
