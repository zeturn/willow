<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // 如果您计划使用软删除 / If you plan to use soft deletes
use App\Traits\UUID;
use Laravel\Scout\Searchable;

class Article extends Model
{
    use UUID;
    use SoftDeletes;
    use Searchable;
    use HasFactory;
    protected $fillable = ['title', 'content', 'user_id'];
}
