<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property int $book_id
 * @property bool $is_returned
 * @property \Illuminate\Support\Carbon|null $return_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Book $book
 * @property-read \App\Models\User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BookCheckout newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookCheckout newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookCheckout query()
 * @method static \Illuminate\Database\Eloquent\Builder|BookCheckout whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookCheckout whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookCheckout whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookCheckout whereReturnDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookCheckout whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookCheckout whereUserId($value)
 *
 * @mixin \Eloquent
 */
final class BookCheckout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'return_date',
        'is_returned'
    ];

    protected $guarded = [
        'user_id',
        'book_id'
    ];

    protected $casts = [
        'return_date' => 'date:d.m.Y',
    ];

    /**
     * Определение связи с моделью User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Определение, просрочена ли дата возврата книги.
     *
     * @return bool true, если дата возврата просрочена, в противном случае - false.
     */
    public function isOverdue(): bool
    {
        return $this->return_date->isPast();
    }

    /**
     * Определение связи с моделью Book
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
