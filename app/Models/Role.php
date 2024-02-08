<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;
use App\Traits\UUID;

class Role extends SpatieRole
{
    use HasFactory;
    use UUID;
    protected $keyType = 'string';
    protected $primaryKey = 'uuid';
}