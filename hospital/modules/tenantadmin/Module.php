<?php

namespace hospital\modules\tenantadmin;

/**
 * modules module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'hospital\modules\tenantadmin\controllers';
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
		//$this->layout = 'main';
        // custom initialization code goes here
        $this->modules = [
            'usersnroles' => [
                'class' => 'common\modules\usersnroles\Module',
                'defaultUrl' => '/tenantadmin/',
                'defaultUrlLabel' => 'Admin',
            ],
        ];
    }
	
	public function beforeAction($action)
	{
		//if (!parent::beforeAction($action)) {
			//return false;
		//}
		// if (\Yii::$app->user->isGuest) {
        //     return \Yii::$app->response->redirect( array('/site/login'))->send();
        // }
		// if (!\Yii::$app->user->can('instituteAdmin')) {
		// 	throw new \yii\web\ForbiddenHttpException('You are not allowed to access this page.');
		// }
        
		return true;
	}
	
}
