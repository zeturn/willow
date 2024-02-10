<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UUID;
use App\Traits\Status;
use Laravel\Scout\Searchable;

/**
 * Represents a Topic in the system.
 * 表示系统中的一个话题。
 */
class Topic extends Model
{
    use HasFactory, SoftDeletes, UUID, Status;
    use Searchable;

    /**
     * The attributes that are mass assignable.
     * 可以批量赋值的属性。
     * @var array
     */
    protected $fillable = ['wall_id', 'name', 'slug', 'description', 'user_id', 'status'];

    /**
     * Attributes that are searchable.
     * 可搜索属性。
     * @var array
     */
    protected $searchable = ['name', 'description'];


    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            // Add other fields you want to index here
        ];
    }

    /**
     * Get the name of the entity.
     * 获取实体名称。
     * @return string
     */
    public function getEntityName() {
        return 'topic';
    }

    /**
     * Change the status of the entry.
     * 更改状态。
     *
     * @param string $newStatus The new status to set. 新的状态。
     * @return void
     */
    public function changeStatus($newStatus)
    {
        $this->update(['status' => $newStatus]);
    }

    /**
     * Change the censor status.
     * 更改审查状态。
     *
     * @param string $newStatus The new censor status to set. 新的审查状态。
     * @return boolean
     */
    public function changeCensorStatus($newStatus){
        // Adjust according to the actual status. 根据实际状态调整。
        $this->changeStatus($newStatus);

        return true;
    }
    
    /**
     * Relationship with Wall.
     * 与Wall的关联。
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function wall()
    {
        return $this->belongsTo(Wall::class);
    }

    /**
     * Relationship with Comment.
     * 与Comment的关联。
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Relationship with Album.
     * 与Album的关联。
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function albums()
    {
        return $this->morphToMany(Album::class, 'entity', 'entity_album_association');
    }

    /**
     * Get EntityAlbumAssociations for the topic.
     * 获取话题的EntityAlbumAssociations。
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function EntityAlbumAssociations() {
        return $this->hasMany(EntityAlbumAssociation::class, 'entity_id')
                    ->where('entity_type', 'topic');
    }

    /**
     * Add an album to the topic.
     * 向话题添加一个相册。
     * @param Album $album The album to add. 要添加的相册。
     * @return mixed
     */
    public function addAlbum($album)
    {
        return EntityAlbumAssociation::addAELink($this, $album);
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
        return $this->isOwnerAndEditorVisible_Wall($this->status);
    }

    /**
     * 检查Owner是否可见
     * 
     * @return bool
     */
    public function isOwnerVisible() {
        return $this->isOwnerVisible_Wall($this->status);
    }

    /**
     * 检查Public是否可编辑
     * 
     * @return bool
     */
    public function isPublicEditable() {
        return $this->isPublicEditable_Wall($this->status);
    }

    /**
     * 检查Owner和Editor是否可编辑
     * 
     * @return bool
     */
    public function isOwnerAndEditorEditable() {
        return $this->isOwnerAndEditorEditable_Wall($this->status);
    }

    /**
     * 检查Owner是否可编辑
     * 
     * @return bool
     */
    public function isOwnerEditable() {
        return $this->isOwnerEditable_Wall($this->status);
    }

    /**
     * 获取审核状态
     * 
     * @return int
     */
    public function getCensorStatus() {
        return $this->censorStatus_Wall($this->status);
    }
}
