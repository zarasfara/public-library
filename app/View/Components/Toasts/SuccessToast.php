<?php

declare(strict_types=1);

namespace App\View\Components\Toasts;

use Closure;
use Illuminate\Contracts\View\View;

class SuccessToast extends BaseToast
{
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.toasts.success-toast');
    }
}
