<?php
namespace common\components;

use common\models\Staff;
use Yii;
use yii\base\Component;


class HspManager extends Component
{
  public function GetHspId(){
    return Yii::$app->params['hsp-id'];
  }

  public function isStaff($id){
    $result = Staff::findOne(['user_id' => $id]);
    if($result == null){
      return false;
    }else{
      return true;
    }
  }
}
