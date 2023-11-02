<?php

namespace hospital\modules\diseases\controllers;

use app\modules\diseases\models\Section;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Class ItemController
 *
 * @package yii2mod\rbac\base
 */
class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}
