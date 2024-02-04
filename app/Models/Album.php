<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // 如果您计划使用软删除 / If you plan to use soft deletes
use App\Traits\UUID;
use App\Traits\Status;

/**
 * 相册模型 / Album Model
 * 
 * 表示音乐或图片等内容的相册 / Represents an album for content like music or pictures.
 */
class Album extends Model
{
    use UUID;
    use Status;
    use SoftDeletes; // 如果您计划使用软删除 / If you plan to use soft deletes

    protected $fillable = ['title', 'user_id', 'status']; // 可填充字段 / Fillable fields
    protected $table = 'albums'; // 显式指定表名 / Explicitly specify table name

    /**
     * 更改状态 / Change the status
     * 
     * 改变相册的状态 / Changes the status of the album.
     *
     * @param string $newStatus 新的状态 / New status
     * @return void
     */
    public function changeStatus($newStatus)
    {
        $this->update(['status' => $newStatus]);
    }

    /**
     * 更改审查状态 / Change Censor Status
     * 
     * 根据实际需要更改相册的审查状态 / Changes the censor status of the album as needed.
     *
     * @param string $newStatus 新的审查状态 / New censor status
     * @return bool
     */
    public function changeCensorStatus($newStatus)
    {
        $this->changeStatus($newStatus);
        return true;
    }

    /**
     * 为当前相册创建审核
     * Create Censor Task for this album.
     * 
     * @param 
     * @return CensorTask $censorTask - 新创建的Task
     */
    public function createCensorTask(){
        return $censorTask = CensorTask::create([
            'entity_type' => 'Album',
            'entity_id' => $this->id,
            'status' => 6,
        ]);
    }

    /**
     * 多对一结构
     * 
     */
    public function censorTasks()
    {
        return $this->hasMany(CensorTask::class, 'entity_id')
                    ->where('entity_type', 'Album');
    }
    
    /**
     * 媒体关系 / Media Relation
     * 
     * 获取与相册关联的所有媒体 / Gets all media associated with the album.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function medias()
    {
        return $this->belongsToMany(Media::class, 'albums_medias_association');
    }

    /**
     * 用户关系 / User Relation
     * 
     * 获取创建相册的用户 / Gets the user who created the album.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 添加媒体 / Add Media
     * 
     * 向相册添加指定媒体 / Adds specified media to the album.
     *
     * @param mixed $media 要添加的媒体 / Media to add
     */
    public function addMedia($media)
    {
        // Add implementation here
    }

    /**
     * 移除媒体 / Remove Media
     * 
     * 从相册移除指定媒体 / Removes specified media from the album.
     *
     * @param mixed $media 要移除的媒体 / Media to remove
     */
    public function removeMedia($media)
    {
        // Add implementation here
    }

    /**
     * 重新排序媒体 / Reorder Media
     * 
     * 根据给定顺序调整相册内媒体的排列 / Reorders the media in the album according to the given order.
     *
     * @param array $order 新的顺序 / New order
     */
    public function reorderMedia($order)
    {
        // Add implementation here
    }

    /**
     * 获取与相册关联的所有实体 / Get All Entities Associated with Album
     * 
     * 获取与相册关联的所有实体，如评论、话题等 / Gets all entities associated with the album, such as comments, topics, etc.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function entities()
    {
        return $this->hasMany(EntityAlbumAssociation::class, 'album_id');
    }

    /**
     * 获取特定类型的实体（话题） / Get Specific Type of Entities (Topics)
     * 
     * 获取与相册关联的特定类型的实体，如话题 / Gets entities of a specific type associated with the album, such as topics.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function topics()
    {
        return $this->entities()->where('entity_type', 'Topic');
    }

    /**
     * 获取特定类型的实体（评论） / Get Specific Type of Entities (Comments)
     * 
     * 获取与相册关联的特定类型的实体，如评论 / Gets entities of a specific type associated with the album, such as comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->entities()->where('entity_type', 'Comment');
    }

    /**
     * 获取特定类型的实体（条目） / Get Specific Type of Entities (Entries)
     * 
     * 获取与相册关联的特定类型的实体，如条目 / Gets entities of a specific type associated with the album, such as entries.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function entries()
    {
        return $this->entities()->where('entity_type', 'App\Models\Entry');
    }
    

    /**
     * 创建相册的静态方法 / Static Method to Create Album
     * 
     * 创建一个新的相册实例 / Creates a new album instance.
     *
     * @param array $data 相册数据 / Album data
     * @return \App\Models\Album
     */
    public static function createAlbum($data)
    {
        return self::create($data);
    }

    /**
     * 添加与实体的关联 / Add Entity-Album Link
     * 
     * 添加与特定实体的关联 / Adds a link with a specific entity.
     *
     * @param mixed $entity 关联的实体 / Entity to link
     * @return mixed
     */
    public function addEntityAlbumLink($entity)
    {
        return EntityAlbumAssociation::addAELink($entity, $this);
    }

    /**
     * --------------------------
     *  状态区域
     * --------------------------
     *  使用 Status trait
     *///
     //###
    /**
     * 检查Owner和Editor是否可见
     * 
     * @return bool
     */
    public function isOwnerAndEditorVisible() {
        return $this->isOwnerAndEditorVisible_Media($this->status);
    }

    /**
     * 检查Owner是否可见
     * 
     * @return bool
     */
    public function isOwnerVisible() {
        return $this->isOwnerVisible_Media($this->status);
    }

    /**
     * 检查Public是否可编辑
     * 
     * @return bool
     */
    public function isPublicEditable() {
        return $this->isPublicEditable_Media($this->status);
    }

    /**
     * 检查Owner和Editor是否可编辑
     * 
     * @return bool
     */
    public function isOwnerAndEditorEditable() {
        return $this->isOwnerAndEditorEditable_Media($this->status);
    }

    /**
     * 检查Owner是否可编辑
     * 
     * @return bool
     */
    public function isOwnerEditable() {
        return $this->isOwnerEditable_Media($this->status);
    }

    /**
     * 获取审核状态
     * 
     * @return int
     */
    public function getCensorStatus() {
        return $this->censorStatus_Media($this->status);
    }
}
