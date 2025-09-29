<?php


namespace App\View\Components;

use Illuminate\View\Component;

class BusinessSubcategoryFilter extends Component
{
    public $subcategories;
    public $action;

    public function __construct($subcategories, $action)
    {
        $this->subcategories = $subcategories;
        $this->action = $action;
    }

    public function render()
    {
        return view('components.business-subcategory-filter');
    }
}
