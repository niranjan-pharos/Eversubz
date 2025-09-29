<?php
namespace App\View\Components;

use Illuminate\View\Component;

class PostCityFilter extends Component
{
    public $topCities;
    public $action;

    public function __construct($topCities, $action)
    {
        $this->topCities = $topCities;
        $this->action = $action;
    }

    public function render()
    {
        return view('components.post-city-filter');
    }
}
