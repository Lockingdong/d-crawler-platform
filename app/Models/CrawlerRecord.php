<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\map;

class CrawlerRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'screenshot',
        'title',
        'url',
        'description',
        'body',
        'user_id'
    ];
}
