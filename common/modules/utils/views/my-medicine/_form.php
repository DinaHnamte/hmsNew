<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Blocks $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="blocks-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $dataChapters=ArrayHelper::map(\models\Chapters::find()->asArray()->all(), 'ChapterId', 'Title'); ?>
	
    <?= CHtml::dropDownList('ChapterId', $dataChapters, 
	         ['prompt'=>'-Select a Chapter-',
			  'onchange'=>'
				$.post( "'.Yii::$app->urlManager->createUrl('getblocks?id=').'"+
                    $(this).val(), function( data ) {
				    $( "select#BlockId" ).html( data );
				});
			']); ?>
    
	<?= $form->field($model, 'BlockId')->dropDownList(array(), 
	         ['prompt'=>'-Select a Blocks-',
			  'onchange'=>'
				$.post( "'.Yii::$app->urlManager->createUrl('getblocks?id=').'"+
                    $(this).val(), function( data ) {
				    $( "select#title" ).html( data );
				});
			']); ?>
    
    <?php ActiveForm::end(); ?>

</div>
