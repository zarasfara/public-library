<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\RoleEnum;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * Модель пользователя.
 *
 * Этот класс представляет собой модель пользователя в системе. Он расширяет
 * стандартную модель Authenticatable для аутентификации и имеет поддержку
 * ролей и разрешений с использованием пакета Spatie/Permission. Также он
 * предоставляет метод для получения URL аватара пользователя.
 *
 * @property int $id Идентификатор пользователя.
 * @property string $name Имя пользователя.
 * @property string $email Электронная почта пользователя.
 * @property string|null $avatar Аватар пользователя.
 * @property \Illuminate\Support\Carbon|null $email_verified_at Время подтверждения адреса электронной почты.
 * @property mixed $password Пароль пользователя.
 * @property string|null $remember_token Токен для "запоминания" пользователя.
 * @property \Illuminate\Support\Carbon|null $created_at Дата и время создания записи.
 * @property \Illuminate\Support\Carbon|null $updated_at Дата и время последнего обновления записи.
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications Коллекция уведомлений пользователя.
 * @property-read int|null $notifications_count Количество уведомлений пользователя.
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens Коллекция токенов пользователя.
 * @property-read int|null $tokens_count Количество токенов пользователя.
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions Коллекция разрешений пользователя.
 * @property-read int|null $permissions_count Количество разрешений пользователя.
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles Коллекция ролей пользователя.
 * @property-read int|null $roles_count Количество ролей пользователя.
 *
 * @method static \Database\Factories\UserFactory factory($count = null, $state = []) Создать новый экземпляр фабрики модели для тестирования.
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery() Создать новый экземпляр запроса модели.
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery() Создать новый экземпляр запроса модели.
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions, $without = false) Поиск пользователей по разрешениям.
 * @method static \Illuminate\Database\Eloquent\Builder|User query() Создать новый экземпляр запроса модели.
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null, $without = false) Поиск пользователей по ролям.
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value) Найти пользователя по аватару.
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value) Найти пользователя по дате создания.
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value) Найти пользователя по электронной почте.
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value) Найти пользователя по времени подтверждения адреса электронной почты.
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value) Найти пользователя по идентификатору.
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value) Найти пользователя по имени.
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value) Найти пользователя по паролю.
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value) Найти пользователя по токену "запоминания".
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value) Найти пользователя по дате последнего обновления.
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutPermission($permissions) Поиск пользователей без указанных разрешений.
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutRole($roles, $guard = null) Поиск пользователей без указанных ролей.
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Book> $reservedBooks
 * @property-read int|null $books_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $reserved_books_count
 *
 * @mixin \Eloquent
 */
final class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

    /**
     * Атрибуты, которые могут быть присвоены массово.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    /**
     * Атрибуты, которые должны быть скрыты при сериализации.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Преобразование атрибутов модели в определенные типы данных.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Возвращает список книг, взятых пользователем.
     */
    public function reservedBooks(): HasManyThrough
    {
        return $this->hasManyThrough(
            Book::class,
            BookCheckout::class,
            'user_id',
            'id',
            'id',
            'book_id'
        )->where('book_checkouts.is_returned', false);
    }

    /**
     * Получить URL аватара пользователя.
     */
    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: function (?string $value) {
                return ! is_null($value) ? asset('storage/'.$value) : null;
            }
        );
    }

    /**
     * Является ли пользователь сотрудником
     */
    public function isEmployee(): bool
    {
        return $this->hasAnyRole(RoleEnum::getAllRoles());
    }
}
