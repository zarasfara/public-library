<?php

declare(strict_types=1);

namespace App\View\Components\Toasts;

use Illuminate\View\Component;

abstract class BaseToast extends Component
{
    public string $message;

    /**
     * Create a new component instance.
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    abstract public function render();
}
