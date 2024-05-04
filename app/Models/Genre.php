<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Genre newModelQuery() Создать новый экземпляр запроса модели.
 * @method static \Illuminate\Database\Eloquent\Builder|Genre newQuery() Создать новый экземпляр запроса модели.
 * @method static \Illuminate\Database\Eloquent\Builder|Genre query() Создать новый экземпляр запроса модели.
 * @method static \Illuminate\Database\Eloquent\Builder|Genre whereId($value) Найти жанр по идентификатору.
 * @method static \Illuminate\Database\Eloquent\Builder|Genre whereName($value) Найти жанр по названию.
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Book> $books
 *
 * @mixin \Eloquent
 */
final class Genre extends Model
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
        'name',
    ];

    /**
     * Отношение "один ко многим" с моделью книги.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Отношение "один ко многим" с моделью книги.
     */
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
