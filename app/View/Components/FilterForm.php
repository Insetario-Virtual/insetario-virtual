<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FilterForm extends Component
{
    public $orders;
    public $families;
    public $cultures;

    /**
     * Create a new component instance.
     */
    public function __construct($orders = [], $families = [], $cultures = [])
    {
        $this->orders = $orders;
        $this->families = $families;
        $this->cultures = $cultures;
    }

    public function render()
    {
        return view('components.filter-form');
    }
}