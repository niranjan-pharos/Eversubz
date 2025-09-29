<?php
namespace App\View\Components;

use Illuminate\View\Component;

class BusinessCategoryFilter extends Component
{
    public $categories;
    public $action;

    public function __construct($categories, $action)
    {
        $this->categories = $categories;
        $this->action = $action;
    }

    public function render()
    {
        return view('components.business-category-filter');
    }
}
