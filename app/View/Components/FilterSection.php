<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FilterSection extends Component
{
    public $title;
    public $items;
    public $inputName;
    public $keyName;

    public function __construct($title, $items, $inputName, $keyName)
    {
        $this->title = $title;
        $this->items = $items;
        $this->inputName = $inputName;
        $this->keyName = $keyName;
    }

    public function render()
    {
        return view('components.filter-section');
    }
}
