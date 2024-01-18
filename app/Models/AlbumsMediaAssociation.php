<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use App\Traits\Status;

class AlbumsMediaAssociation extends Model
{
    use UUID;    use Status;
    protected $fillable = ['album_id', 'media_id'];
    protected $table ="albums_medias_association";
    
    public function album()
    {
        // 与 Albums 模型的多对一关系
        return $this->belongsTo(Album::class);
    }

    public function media()
    {
        // 与 Medias 模型的多对一关系
        return $this->belongsTo(Media::class);
    }
}
