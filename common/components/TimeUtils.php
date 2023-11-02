<?php
namespace common\components;

use Yii;
use yii\base\Component;
use DateTime;

class TimeUtils extends Component
{
  public function getAge($dob){
    $dob = new DateTime($dob);
    $now = new DateTime();
    $diff = $now->diff($dob);
    return $diff->y;
  }
}
