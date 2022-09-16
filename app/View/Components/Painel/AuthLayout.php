<?php

namespace App\View\Components\Painel;

use Illuminate\View\Component;

class AuthLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.painel.auth');
    }
}
