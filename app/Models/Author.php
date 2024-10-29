<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
final class Author extends Model
{
    use HasFactory;

    /**
     * Определяет, следует ли обрабатывать временные метки модели.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Атрибуты, которые могут быть присвоены массово.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'patronymic',
    ];

    /**
     * Получить полное имя автора.
     *
     * @return string Полное имя автора.
     */
    public function getFullName(): string
    {
        return sprintf('%s %s %s', $this->first_name, $this->last_name, $this->patronymic ?? '');
    }

    /**
     * Отношение "один ко многим" с моделью книги.
     *
     * @return HasMany Связь "один ко многим" с моделью книги.
     */
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
