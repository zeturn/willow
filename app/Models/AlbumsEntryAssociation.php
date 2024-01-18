<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use App\Traits\Status;

class AlbumsEntryAssociation extends Model
{
    use UUID;
    use Status;
    
    protected $fillable = ['album_id', 'entity_id', 'entity_type'];

    public function album()
    {
        // 与 Albums 模型的多对一关系
        return $this->belongsTo(Album::class);
    }

    public function entity()
    {
        // 定义多态关系
        return $this->morphTo();
    }
}
