<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class Favorite extends Model
{
    use HasFactory;
    use UUID;

    protected $fillable = [
        'id',
        'name',
        'description',
        'favorites',
        'status',
    ];

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_favorites');
    }
    
    public function userFavorites()
    {
        return $this->hasMany(UserFavorites::class, 'favorites_id', 'id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorites::class, 'favorites_id', 'id');
    }
}
