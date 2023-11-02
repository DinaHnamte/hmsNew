<?php

namespace common\modules\encounters;

/**
 * modules module definition class
 */
class Module extends \yii\base\Module
{

    /**
     * @var string Default url for breadcrumb
     */
    public $encounterType;

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
    public $controllerNamespace = 'common\modules\encounters\controllers';
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
		
        $this->modules = [
            'vitalsign' => [
                'class' => 'common\modules\vitalsigns\Module',
                'defaultUrl' => '/opd/',
                'defaultUrlLabel' => 'OPD Counter',
            ],
        ];
		
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
            }
            return true;
        }
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
