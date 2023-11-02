<?php

namespace common\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class SearchBox extends Widget
{
    public $targetId;
    public $placeholder;

    public function init()
    {           
        parent::init();
    }

    public function run()
    {
        return $this->render('search-box', [
            'targetId' => $this->targetId, 'placeholder' => $this->placeholder
        ]);
    }
}
