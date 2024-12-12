<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * Модель автора книги.
 * 
 * Этот класс представляет собой модель автора книги в системе. Он содержит
 * информацию о фамилии, имени и отчестве автора, а также связь с книгами,
 * которые им написаны.
 *
 * @property int $id Идентификатор автора.
 * @property string $first_name Имя автора.
 * @property string $last_name Фамилия автора.
 * @property string|null $patronymic Отчество автора.
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Book> $books Список книг, написанных автором.
 * @property-read int|null $books_count Количество книг, написанных автором.
 * @method static \Database\Factories\AuthorFactory factory($count = null, $state = []) Создать новый экземпляр фабрики модели для тестирования.
 * @method static \Illuminate\Database\Eloquent\Builder|Author newModelQuery() Создать новый экземпляр запроса модели.
 * @method static \Illuminate\Database\Eloquent\Builder|Author newQuery() Создать новый экземпляр запроса модели.
 * @method static \Illuminate\Database\Eloquent\Builder|Author query() Создать новый экземпляр запроса модели.
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereFirstName($value) Найти автора по имени.
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereId($value) Найти автора по идентификатору.
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereLastName($value) Найти автора по фамилии.
 * @method static \Illuminate\Database\Eloquent\Builder|Author wherePatronymic($value) Найти автора по отчеству.
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Book> $books
 * @mixin \Eloquent
 */
	final class Author extends \Eloquent {}
}

namespace App\Models{
/**
 * Модель книги.
 * 
 * Этот класс представляет собой модель книги в системе. Он содержит информацию
 * о заголовке, описании, авторе, наличии и изображении книги. Также он имеет
 * отношения с жанрами книги.
 *
 * @property int $id Идентификатор книги.
 * @property string $title Заголовок книги.
 * @property string $description Описание книги.
 * @property int $author_id Идентификатор автора книги.
 * @property int $available Наличие книги.
 * @property string $image Путь к изображению книги.
 * @property \Illuminate\Support\Carbon|null $created_at Дата и время создания записи.
 * @property \Illuminate\Support\Carbon|null $updated_at Дата и время последнего обновления записи.
 * @property-read \App\Models\Author $author Автор книги.
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Genre> $genres Список жанров книги.
 * @property-read int|null $genres_count Количество жанров книги.
 * @method static \Database\Factories\BookFactory factory($count = null, $state = []) Создать новый экземпляр фабрики модели для тестирования.
 * @method static \Illuminate\Database\Eloquent\Builder|Book newModelQuery() Создать новый экземпляр запроса модели.
 * @method static \Illuminate\Database\Eloquent\Builder|Book newQuery() Создать новый экземпляр запроса модели.
 * @method static \Illuminate\Database\Eloquent\Builder|Book query() Создать новый экземпляр запроса модели.
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereAuthorId($value) Найти книгу по идентификатору автора.
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereAvailable($value) Найти книгу по наличию.
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereCreatedAt($value) Найти книгу по дате создания.
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereDescription($value) Найти книгу по описанию.
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereId($value) Найти книгу по идентификатору.
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereImage($value) Найти книгу по изображению.
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereTitle($value) Найти книгу по заголовку.
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereUpdatedAt($value) Найти книгу по дате последнего обновления.
 * @property-read \App\Models\BookCheckout|null $bookCheckouts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Genre> $genres
 * @property-read int|null $book_checkouts_count
 * @property-read \App\Models\User|null $user
 * @mixin \Eloquent
 */
	final class Book extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $book_id
 * @property bool $is_returned
 * @property \Illuminate\Support\Carbon|null $return_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Book $book
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|BookCheckout newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookCheckout newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookCheckout query()
 * @method static \Illuminate\Database\Eloquent\Builder|BookCheckout whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookCheckout whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookCheckout whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookCheckout whereReturnDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookCheckout whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookCheckout whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookCheckout whereIsReturned($value)
 * @mixin \Eloquent
 */
	final class BookCheckout extends \Eloquent {}
}

namespace App\Models{
/**
 * Модель жанра книги.
 * 
 * Этот класс представляет собой модель жанра книги в системе. Он содержит
 * информацию о названии жанра и имеет отношение "один ко многим" с моделью
 * книги, чтобы указать книги, принадлежащие данному жанру.
 *
 * @property int $id Идентификатор жанра.
 * @property string $name Название жанра.
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Book> $books Список книг, относящихся к данному жанру.
 * @property-read int|null $books_count Количество книг, относящихся к данному жанру.
 * @method static \Illuminate\Database\Eloquent\Builder|Genre newModelQuery() Создать новый экземпляр запроса модели.
 * @method static \Illuminate\Database\Eloquent\Builder|Genre newQuery() Создать новый экземпляр запроса модели.
 * @method static \Illuminate\Database\Eloquent\Builder|Genre query() Создать новый экземпляр запроса модели.
 * @method static \Illuminate\Database\Eloquent\Builder|Genre whereId($value) Найти жанр по идентификатору.
 * @method static \Illuminate\Database\Eloquent\Builder|Genre whereName($value) Найти жанр по названию.
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Book> $books
 * @mixin \Eloquent
 */
	final class Genre extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $keywords
 * @property string|null $robots
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|MetaTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MetaTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MetaTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|MetaTag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MetaTag whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MetaTag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MetaTag whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MetaTag whereRobots($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MetaTag whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MetaTag whereUpdatedAt($value)
 */
	class MetaTag extends \Eloquent {}
}

namespace App\Models{
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Book> $reservedBooks
 * @property-read int|null $books_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $reserved_books_count
 * @mixin \Eloquent
 */
	final class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $week_start
 * @property int $visitors
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat query()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat whereVisitors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat whereWeekStart($value)
 * @mixin \Eloquent
 */
	final class VisitorStat extends \Eloquent {}
}

