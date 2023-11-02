<?php

namespace common\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class SearchTable extends Widget
{
    public $tableId;
    public $columnIndex;
    public $placeholder;

    public function init()
    {           
        parent::init();
    }

    public function run()
    {
        return $this->render('search-table', [
            'tableId' => $this->tableId, 'placeholder' => $this->placeholder,
            'columnIndex' => $this->columnIndex
        ]);
    }
}
