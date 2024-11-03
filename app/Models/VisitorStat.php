<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class VisitorStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'week_start',
        'visitors',
    ];
}
