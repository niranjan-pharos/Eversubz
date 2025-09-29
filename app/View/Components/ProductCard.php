<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductCard extends Component
{
    public $item;

    public function __construct($post)
    {
        $this->item = $post;
    }

    public function render()
    {
        return view('components.product-card', ['post' => $this->item]);
    }


}
