<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DataTable extends Component
{
    public $title;
    public $columns;
    public $tableId;
    public $addButton;
    public $addButtonLink;
    public $actionsColumn;

    /**
     * Create a new component instance.
     */
    public function __construct($title, $columns, $tableId = 'dataTable', $addButton = false, $addButtonLink = '', $actionsColumn = false)
    {
        $this->title = $title;
        $this->columns = $columns;
        $this->tableId = $tableId;
        $this->addButton = $addButton;
        $this->addButtonLink = $addButtonLink;
        $this->actionsColumn = $actionsColumn;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.data-table');
    }
}
