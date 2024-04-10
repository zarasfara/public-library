<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
 *
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
 *
 * @mixin \Eloquent
 */
final class Book extends Model
{
    use HasFactory;

    /**
     * Атрибуты, которые могут быть присвоены массово.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'description',
        'author_id',
        'available',
        'image',
    ];

    /**
     * Отношение "один ко многим" с моделью автора.
     *
     * @return BelongsTo Отношение "один ко многим" с моделью автора.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Отношение "многие ко многим" с моделью жанра.
     *
     * @return BelongsToMany Отношение "многие ко многим" с моделью жанра.
     */
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    public function getImageUrl(): string
    {
        return asset('storage/'.$this->image);
    }
}
