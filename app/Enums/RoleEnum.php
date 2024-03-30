<?php

declare(strict_types=1);

namespace App\Enums;

enum RoleEnum: string
{
    case LIBRARIAN = 'librarian';
    case ADMINISTRATOR = 'administrator';
    case SECRETARY = 'secretary';
}
