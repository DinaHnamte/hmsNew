<?php

namespace hospital\modules\tenantadmin\controllers;

use Yii;
use common\models\Hsp;
use yii\web\Controller;

/**
 * Default controller for the `modules` module
 */
class InstprofileController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
	 
    public function actionIndex()
    {
        return $this->redirect(['default/index']);
    }
	
		
	public function actionUpdateinst()
    {
		$idinst = Yii::$app->session->get('idinstn');
        $model = Hsp::findOne($idinst);
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['default/index']);
        }

        return $this->render('updateinst', [
            'model' => $model,
        ]);
    }
	
	
}
