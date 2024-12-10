<?php

declare(strict_types=1);

namespace App\View\Composers;

use App\Models\MetaTag;
use Illuminate\View\View;

final class MetaTagComposer
{
    public function compose(View $view): void
    {
        $view->with('meta', MetaTag::query()->first());
    }
}
