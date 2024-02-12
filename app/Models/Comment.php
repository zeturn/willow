<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UUID;
use App\Traits\Status;
use Laravel\Scout\Searchable;

class Comment extends Model
{
    use HasFactory, SoftDeletes, UUID, Status;
    use Searchable;

    protected $fillable = ['topic_id', 'user_id', 'content', 'parent_id', 'status'];

    // 可搜索属性
    protected $searchable = ['content'];

    public function getAllChildrenComments($commentId)
    {
        $comments = Comment::where('parent_id', $commentId)->get();
        $allComments = [];

        foreach ($comments as $comment) {
            $allComments[] = $comment;
            // 递归调用getAllChildrenComments()方法以获取当前评论的所有子评论
            $allComments = array_merge($allComments, $this->getAllChildrenComments($comment->id));
        }

        return $allComments;
    }

    // 定义关联来获取直接子评论
    public function childrenComments()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            // Add other fields you want to index here
        ];
    }
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

    /**
     * Establishes a relationship with the Topic model.
     * 建立与Topic模型的关联关系。
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo The relationship query builder.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo 关系查询构建器。
     */
    public function topic()
    {
        // Return the belongsTo relationship with Topic model.
        // 返回与Topic模型的belongsTo关系。
        return $this->belongsTo(Topic::class);
    }

    /**
     * Establishes a relationship with the User model.
     * 建立与User模型的关联关系。
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo The relationship query builder.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo 关系查询构建器。
     */
    public function user()
    {
        // Return the belongsTo relationship with User model.
        // 返回与User模型的belongsTo关系。
        return $this->belongsTo(User::class);
    }

    /**
     * Establishes a many-to-many polymorphic relationship with Album.
     * 建立与Album的多对多多态关联关系。
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany The relationship query builder.
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany 关系查询构建器。
     */
    public function albums()
    {
        // Return the morphToMany relationship with Album model.
        // 返回与Album模型的morphToMany关系。
        return $this->morphToMany(Album::class, 'entity', 'entity_album_association');
    }

    /**
     * Retrieves EntityAlbumAssociations where entity_type is 'comment'.
     * 获取entity_type为'comment'的EntityAlbumAssociations。
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany The relationship query builder.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany 关系查询构建器。
     */
    public function EntityAlbumAssociations()
    {
        // Return the hasMany relationship with EntityAlbumAssociation model, filtering by entity_type.
        // 返回与EntityAlbumAssociation模型的hasMany关系，并通过entity_type进行过滤。
        return $this->hasMany(EntityAlbumAssociation::class, 'entity_id')
                    ->where('entity_type', 'comment');
    }

    /**
     * Adds an album to the entity.
     * 将相册添加到实体。
     *
     * @param \App\Models\Album $album The album to add.
     * @param \App\Models\Album $album 要添加的相册。
     * @return mixed The result of the association operation.
     * @return mixed 关联操作的结果。
     */
    public function addAlbum($album)
    {
        if (!($album instanceof Album)) {
            // Return an error view if the provided album is not an instance of Album model.
            // 如果提供的相册不是Album模型的实例，则返回错误视图。
            return view('errors.general', ['message' => 'Invalid album type provided'], 500);
        }

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