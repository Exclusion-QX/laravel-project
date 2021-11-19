<?php

namespace App\View\Components\Tables;

use Illuminate\View\Component;

class Tasks extends Component
{
    public $id;
    public $title;
    public $description;
    public $created;
    public $deadline;
    public $priority;
    public $status;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $title, $description, $created, $deadline, $priority, $status)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->created = $created;
        $this->deadline = $deadline;
        $this->priority = $priority;
        $this->status = $status;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tables.tasks');
    }
}
