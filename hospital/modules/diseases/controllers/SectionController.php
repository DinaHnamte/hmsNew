<?php

namespace hospital\modules\diseases\controllers;

use app\models\Hsp;
use app\modules\diseases\models\Section;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Cookie;

/**
 * Class ItemController
 *
 * @package yii2mod\rbac\base
 */
class SectionController extends Controller
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
        $dataProvider = new ActiveDataProvider([
            'query' => Section::find(),
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }
}
