<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AppLayout extends Component
{
    /**
     * Membuat instance component.
     */
    public function __construct()
    {
        //
    }

    /**
     * Mengambil view untuk component.
     */
    public function render(): View|Closure|string
    {
        return view('components.app-layout');
    }
}