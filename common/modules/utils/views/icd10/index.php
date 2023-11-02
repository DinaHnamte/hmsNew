<?php

use common\models\utilities\Icd10;
use common\models\utilities\Blocks;
use common\models\utilities\Chapters;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Icd10s';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="icd10-index">

    <h3><?= Html::encode("Select Disease") ?></h3>

       
	<p>
    <?= Html::dropDownList('chapterid','',ArrayHelper::map(Chapters::find()->all(), 'id', 'title'),
	         [  'id' => 'chapterid',
                'prompt'=>'-Select a Chapter-',
                'onchange'=>'
                    $.post( "'.Yii::$app->urlManager->createUrl('icd10/default/getblocks').'",
                        {chapterid: $(this).val()}, function( data ) {
                        //alert(data);
                        $("select#blockid" ).html( data );
                        $("#blockid").trigger("change");
                    });
			']); ?>
    </p>
    <p>
	<?= Html::dropDownList('blockid','', array(),
                ['id' => 'blockid',
                'prompt'=>'-Select a Blocks-',
                'onchange'=>'
                    $.post( "'.Yii::$app->urlManager->createUrl('icd10/default/geticd10').'",
                    {blockid: $(this).val()}, function( data ) {
                        //alert(data);
                        $("#icd10table" ).html(data);
                    });
                ']); ?>
    
    </p>

    <?php Pjax::begin(['id' => 'icd10table']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'Level',
            //'Category',
            //'ChapterId',
            //'BlockId',
            //'Dagger',
            'Aster',
            //'WithoutDot',
            'title',
            //'Mortality1',
            //'Mortality2',
            //'Mortality3',
            //'Mortality4',
            //'Mortality5',
            
        ],
    ]); ?>
    <?php Pjax::end(); ?>


</div>

