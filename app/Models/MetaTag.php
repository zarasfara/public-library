<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $keywords
 * @property string|null $robots
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
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
 *
 * @mixin \Eloquent
 */
class MetaTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'keywords',
        'robots',
    ];
}
