<?php
namespace common\components;

use common\models\Employee;
use Yii;
use yii\base\Component;


class TenantManager extends Component
{
  public static function getTenantId(){
    return Yii::$app->params['tenant-id'];
  }

  public static function setTenantId(){
    return Yii::$app->params['tenant-id'];
  }

  public function isStaff($id){
    $result = Employee::findOne(['user_id' => $id]);
    if($result == null){
      return false;
    }else{
      return true;
    }
  }
}
