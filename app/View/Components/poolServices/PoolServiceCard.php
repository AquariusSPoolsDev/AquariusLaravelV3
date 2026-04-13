<?php

namespace App\View\Components\poolServices;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PoolServiceCard extends Component
{
    public $title;
    public $content;
    public $image;
    public $isReversed;

    public function __construct($title, $content, $image, $isReversed = false)
    {
        $this->title = $title;
        $this->content = $content;
        $this->image = $image;
        $this->isReversed = $isReversed;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pool-services.pool-service-card');
    }
}
