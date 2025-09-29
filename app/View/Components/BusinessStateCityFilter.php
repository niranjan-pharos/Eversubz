<?php
namespace App\View\Components;

use Illuminate\View\Component;

class BusinessStateCityFilter extends Component
{
    public $statesWithCities;
    public $action;

    public function __construct($statesWithCities, $action)
    {
        $this->statesWithCities = $statesWithCities;
        $this->action = $action;
    }

    public function render()
    {
        return view('components.business-state-city-filter');
    }
}
