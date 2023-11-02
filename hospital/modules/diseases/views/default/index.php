<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<h1>Diseases</h1>

<p>View by :</p>

<?= Html::a('Sections', Url::to('diseases/section/index'))?>
<?= Html::a('All Diseases', Url::to('diseases/all-diseases/index'))?>