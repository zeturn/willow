<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class Like extends Model
{
    use HasFactory;
    use UUID;
    
    protected $fillable = [
        'user_id',
        'model_type',
        'model_id',
    ];
}
