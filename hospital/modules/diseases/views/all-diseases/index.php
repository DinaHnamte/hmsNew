<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

?>


<h1>All Diseases</h1>

<div style="display: flex; flex-direction: row; padding: 10px; align-items: center; justify-content: center ;border: 1px solid grey">
  <?php
    foreach(range('A','Z') as $letter){
      $url = Url::to(['all-diseases/sort', 'letter' => $letter]);
      echo Html::a($letter, $url, 
        ['style' => 'display: flex; width: 20px; height: 20px; margin: 0px; justify-content: center; align-items: center']);
      }
    
    echo Html::textInput("search-disease", null, ['id' => 'search-disease', 'style' => 'margin-left: 40px;']);
  ?>
</div>

<?php Pjax::begin(['id' => 'diseasesgrid']); ?>
<?php echo $this->render('view', ['dataProvider' => $dataProvider]);?>
<?php Pjax::end(); ?>

<?php
$this->registerJs('
$(document).ready(function() {
  $(document).on("input", "#search-disease", function () {
    if (this.value.length >= 3) {
      $.get("'.Url::to(['all-diseases/search']).'", { letter: this.value }, function (data) {
        $("#diseasesgrid").html(data);
      });
    }
  });
});
');
?>