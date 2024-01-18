<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use App\Traits\Status;

class EntityAlbumAssociation extends Model
{
    use HasFactory;
    use UUID;
    use Status;

    protected $table = 'entity_album_association';
    protected $fillable = ['entity_id', 'entity_type', 'album_id', 'status'];
    public $incrementing = false;  // 主键不是自增长的
    protected $keyType = 'string'; // 主键类型为字符串


        /**
     * 更改状态。
     * Change the status of the entry.
     *
     * @param string $newStatus - 新的状态
     * @return void
     */
    public function changeStatus($newStatus)
    {
        $this->update(['status' => $newStatus]);
    }

    public function changeCensorStatus($newStatus){
        //需要根据实际状态调整
        $this->changeStatus($newStatus);

        return true;
    }

    /**
     * Retrieves associated topics for the album.
     * 获取相册关联的主题。
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphedByMany The relationship query builder.
     * @return \Illuminate\Database\Eloquent\Relations\MorphedByMany 返回关系查询构建器。
     */
    public function topic()
    {
        return $this->morphedByMany(Topic::class, 'Topic', 'entity_album_association');
    }

    /**
     * Retrieves associated comments for the album.
     * 获取相册关联的评论。
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphedByMany The relationship query builder.
     * @return \Illuminate\Database\Eloquent\Relations\MorphedByMany 返回关系查询构建器。
     */
    public function comment()
    {
        return $this->morphedByMany(Comment::class, 'Comment', 'entity_album_association');
    }

    /**
     * Retrieves associated entries for the album.
     * 获取相册关联的条目。
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphedByMany The relationship query builder.
     * @return \Illuminate\Database\Eloquent\Relations\MorphedByMany 返回关系查询构建器。
     */
    public function entry()
    {
        return $this->morphedByMany(Entry::class, 'Entry', 'entity_album_association');
    }


    public static function addAELink($entity, $album)
    {
        return self::create([
            'entity_id' => $entity->id,
            'entity_type' => get_class($entity),
            'album_id' => $album->id,
            'status' => 5,
        ]);
    }
    
}
