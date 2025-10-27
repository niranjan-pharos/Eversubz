<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Services\CountService;

class Counts1 extends Component
{
    public $totalAdPosts;
    public $totalBusinessProducts;
    public $totalEvents;

    public function __construct($userId)
    {
        $counts = CountService::getCounts($userId);
        $this->totalAdPosts = $counts['totalAdPosts'];
        $this->totalBusinessProducts = $counts['totalBusinessProducts'];
        $this->totalEvents = $counts['totalEvents'];
    }

    public function render()
    {
        return view('components.counts1');
    }
}
