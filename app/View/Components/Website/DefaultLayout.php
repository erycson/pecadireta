<?php

namespace App\View\Components\Website;

use Illuminate\View\Component;

class DefaultLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.website.default');
    }
}
