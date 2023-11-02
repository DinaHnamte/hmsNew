<?php

namespace common\modules\usersnroles;

/**
 * modules module definition class
 */
class Module extends \yii\base\Module
{
    //public $defaultRoute = 'usersnroles';

    /**
     * @var string Default url for breadcrumb
     */
    public $defaultUrl;

    /**
     * @var string Default url label for breadcrumb
     */
    public $defaultUrlLabel;

    
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'common\modules\usersnroles\controllers';
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
		//$this->layout = 'main';
        // custom initialization code goes here
    }
	
	public function beforeAction($action)
	{
        
        if (parent::beforeAction($action)) {            
            /* @var $action \yii\base\Action */
            if($this->defaultUrlLabel !==''){
                $view = $action->controller->getView();
                $view->params['breadcrumbs'][] = [
                    'label' => ($this->defaultUrlLabel ?: 'Admin'),
                    'url' => ['/' . ($this->defaultUrl ?: $this->uniqueId)],
                ];
            
            return true;
        }
    }
        
		//if (!parent::beforeAction($action)) {
			//return false;
		//}
		//if (\Yii::$app->user->isGuest) {
            //return \Yii::$app->response->redirect( array('/site/login'))->send();
        //}
		// if (!\Yii::$app->user->can('instituteAdmin')) {
		// 	throw new \yii\web\ForbiddenHttpException('You are not allowed to access this page.');
		// }
	}
	
}
