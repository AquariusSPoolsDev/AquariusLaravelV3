<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class Seo extends Component
{
    public $ogSiteTitle;

    public $ogPageTitle;

    public $ogDescription;

    public $ogTags;

    public $ogImage;

    public function __construct($ogPageTitle = '', $ogDescription = '', $ogTags = '', $ogImage = '')
    {
        if (Route::currentRouteName() === 'homepage') {
            $this->ogSiteTitle = 'Johor Bahru (JB) Swimming Pool Builder and Contractor Specialist | Aquarius Swimming Pools';
        } else {
            $this->ogSiteTitle = $ogPageTitle.' | Johor Bahru (JB) Swimming Pool Specialist | Aquarius Swimming Pools';
        }

        $this->ogDescription = $ogDescription;
        $this->ogTags = $ogTags;
        $this->ogImage = $ogImage;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.seo.seo');
    }
}
