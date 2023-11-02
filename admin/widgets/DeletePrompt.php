<?php

namespace common\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class DeletePrompt extends Widget
{
    public $targetId;

    public function init()
    {           
        parent::init();
    }

    public function run()
    {
        return $this->render('delete-prompt', [
            'targetId' => $this->targetId,
        ]);
    }
}
