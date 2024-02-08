<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;
use App\Traits\UUID;

class Permission extends SpatiePermission
{
    use HasFactory;
    use UUID;
    protected $keyType = 'string';
    protected $primaryKey = 'uuid';
}