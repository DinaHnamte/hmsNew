<?php

use common\models\auth\Tenant;
use common\models\Encounter;
use common\models\auth\RegUser;
use common\models\Diagnosis;
use common\models\Prescript;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>
<div style="padding: 20px">
  <h1> <?=$hsp->name . ' ' . $hsp->type ?> </h1>
  <p> Phone: <?= $hsp->mobno ?> </p>
  <p> Email: <?= $hsp->email ?></p>

  <hr style="border-top: 2px solid black; border-bottom: 1px solid #fcc;">


  <div pdf-section style="display: flex; flex-direction: column; margin: 20px">
    <table width="100%">
      <tr>
          <td align="left"> Date: <?= date('y/m/d') ?> </td>
          <td align="right"> <barcode code=<?= strtoupper($encounter->id) ?> type='C128A' size='0.5'/> </td>
      </tr>
    </table>

    <table width="100%">
      <tr>
          <td align="left"> Name: <?= $patient->name ?> </td>
          <td align="right"> Age: <?= Yii::$app->timeUtils->getAge($patient->dob) ?> </td>
      </tr>
    </table>

    <table width="100%">
      <tr>
          <td align="left"> Address: <?= $patient->add1 . ', ' . $patient->dist ?> </td>
          <td align="right"> Phone: <?= $patient->mobno ?> </td>
      </tr>
    </table>
  </div>

  <hr style="border-top: 2px solid black; border-bottom: 1px solid #fcc;">

  <div pdf-section style="display: flex; flex-direction: column; margin: 20px; font-size: 1.1rem">
    <p>Diagnosis:</p>
    <div style="margin-left: 80px">
        <?php
        $data = $diagnosis->all();
        foreach($data as $index => $diagnosis):
        ?>
        <p><?= ($index+1) . ". " .$diagnosis->diag ?></p>
        <?php endforeach ?>
    </div>

    <p>Prescriptions:</p>
    <div style="margin-left: 80px">
        <?php
        $data = $prescriptions->all();
        foreach($data as $index => $prescriptions):
        ?>
        <p><?= ($index+1) . ". " . $prescriptions->medi . " || Dose: " . $prescriptions->dose ?></p>
        <?php endforeach ?>
    </div>
    </div>

    <div style="display:flex; position: absolute; bottom: 10px; right:10px">
      <table width="100%">
        <tr>
            <td align="right"> Consultant</td>
        </tr>
        <tr>
            <td align="right"> <?= $doctor->name ?></td>
        </tr>
      </table> 
    </div>
    
  
</div>

