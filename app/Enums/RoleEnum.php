<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Перечисление ролей пользователей.
 *
 * Это перечисление представляет собой список доступных ролей пользователей
 * в системе. Каждая роль имеет уникальное строковое значение.
 */
enum RoleEnum: string
{
    /**
     * Роль библиотекаря.
     */
    case LIBRARIAN = 'librarian';

    /**
     * Роль администратора.
     */
    case ADMINISTRATOR = 'administrator';

    /**
     * Роль секретаря.
     */
    case SECRETARY = 'secretary';
}
