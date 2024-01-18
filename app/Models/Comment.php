<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UUID;
use App\Traits\Status;

class Comment extends Model
{
    use HasFactory, SoftDeletes, UUID, Status;

    protected $fillable = ['topic_id', 'user_id', 'content', 'status'];

    // 可搜索属性
    protected $searchable = ['content'];

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
     * 获取子评论。
     */
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    /**
     * 判断是否为顶级评论。
     */
    public function isTopLevel()
    {
        return is_null($this->parent_id);
    }

    // 与Topic关联
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    // 与User关联
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function albums()
    {
        return $this->morphToMany(Album::class, 'entity', 'entity_album_association');
    }

    public function EntityAlbumAssociations() {
        return $this->hasMany(EntityAlbumAssociation::class, 'entity_id')
                    ->where('entity_type', 'comment');
    }

    public function addAlbum($album)
    {
        return EntityAlbumAssociation::addAELink($this, $album);
    }
}