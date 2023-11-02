<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>
<h1>Admin</h1>

<div style="display: flex; flex-direction:column; align-items: center;">
  
  <p>
      <?= Html::a('Approved Health Service Providers', ["tenant-index"],
          ['class' => 'btn btn-outline-secondary']) ?>
  </p>
  <p>
      <?= Html::a('Unapproved Health Service Providers', ["xtenant-index"],
          ['class' => 'btn btn-outline-secondary']) ?>
  </p>
  <p>
      <?= Html::a('Application Roles', ["get-roles"],
          ['class' => 'btn btn-outline-secondary']) ?>
  </p>
  <p>
      <?= Html::a('Application Admins', ["get-admins"],
          ['class' => 'btn btn-outline-secondary']) ?>
  </p>
</div>
