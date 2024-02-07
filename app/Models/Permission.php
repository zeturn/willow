<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;
use App\Traits\UUID;

class Permission extends SpatiePermission
{
    use HasFactory;
    use UUID;

    protected $fillable = ['name','guard_name','created_at','updated_at'];
}