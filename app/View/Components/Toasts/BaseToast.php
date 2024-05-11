<?php

namespace App\View\Components\Toasts;

use Illuminate\View\Component;

abstract class BaseToast extends Component
{
    public string $message;

    /**
     * Create a new component instance.
     *
     * @param string $message
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    abstract public function render();
}
