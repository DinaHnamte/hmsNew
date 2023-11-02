<?php

namespace hospital\modules\diseases;

/**
 * modules module definition class
 */
class Module extends \yii\base\Module
{
   
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'hospital\modules\diseases\controllers'; 
    
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
		
        // custom initialization code goes here
		
    }
	
	public function beforeAction($action)
	{
		//if (!parent::beforeAction($action)) {
			//return false;
		//}
		//if (\Yii::$app->user->isGuest) {
            //return \Yii::$app->response->redirect( array('/site/login'))->send();
        //}
		//if (!\Yii::$app->user->can('appAdmin')) {
			//throw new \yii\web\ForbiddenHttpException('You are not allowed to access this page.');
		//}

		return true;
	}
	
}
