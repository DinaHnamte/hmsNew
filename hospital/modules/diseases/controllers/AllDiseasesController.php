<?php

namespace hospital\modules\diseases\controllers;

use app\modules\diseases\models\Diseases;
use app\modules\diseases\models\Section;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

/**
 * Class ItemController
 *
 * @package yii2mod\rbac\base
 */
class AllDiseasesController extends Controller
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
        return $this->render('index', ['dataProvider' => null]);
    }

    public function actionSort(){
        $letter = $this->request->get("letter");
        $dataProvider = new ActiveDataProvider([
            'query' => Diseases::find()->where(['like', 'title', $letter.'%', false]),
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

        public function actionSearch(){
        $letter = $this->request->get("letter");
        $dataProvider = new ActiveDataProvider([
            'query' => Diseases::find()->where(['like', 'title', $letter.'%', false]),
        ]);
        return $this->renderPartial('view', ['dataProvider' => $dataProvider]);
    }
}
