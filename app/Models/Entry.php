<?php

/**
 * Entry模型文件
 * 
 * @author      Henry
 * @version     V 0.0.1
 * @link        http://www.memegit.com
 * 
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use App\Traits\Status;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entry extends Model
{
    use HasFactory;
    use UUID;
    use Status;
    protected $guarded = [];  // 没有受保护的字段
    public $incrementing = false;  // 主键不是自增长的
    protected $keyType = 'string'; // 主键类型为字符串

    protected $fillable = ['id', 'name', 'demo_branch_id', 'status']; // 可填充的字段

    public function getEntityName() {
        return 'entry';
    }
    
    /**
     * 返回一个词条所有的分支（CB和PB）。
     * Return all branches (CB and PB) of an entry.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function branches()
    {
        return $this->hasMany(EntryBranch::class, 'entry_id', 'id');
    }

    /**
     * 获取该词条的 Demo Branch。
     * Get the Demo Branch of this entry.
     *
     * @return EntryBranch
     */
    public function getDemoBranch()
    {
        return $this->belongsTo(EntryBranch::class, 'demo_branch_id', 'id')->first();
    }

    /**
     * 更改该词条的 Demo Branch。
     * Change the Demo Branch of this entry.
     *
     * @param string $newDemoBranchId - 新的Demo Branch的ID
     * @return void
     */
    public function changeDemoBranch($newDemoBranchId)
    {
        $this->update(['demo_branch_id' => $newDemoBranchId]);
    }

    /**
     * 为当前词条创建审核
     * Create Censor Task for this entry.
     * 
     * @param 
     * @return CensorTask $censorTask - 新创建的Task
     */
    public function createCensorTask(){
        return $censorTask = CensorTask::create([
            'entity_type' => 'Entry',
            'entity_id' => $this->id,
            'status' => 5,
        ]);
    }

    public function censorTasks()
    {
        return $this->hasMany(CensorTask::class, 'entity_id')
                    ->where('entity_type', 'Entry');
    }

    /**
     * 获取词条的所有版本（通过分支）。
     * Get all versions of the entry (through branches).
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function allVersions()
    {
        return $this->hasManyThrough(EntryVersion::class, EntryBranch::class, 'entry_id', 'Entry_Branch_ID', 'id', 'id');
    }

    /**
     * 添加新的分支。
     * Add a new branch to the entry.
     *
     * @param array $data - 新分支的数据
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function addBranch($data)
    {
        return $this->branches()->create($data);
    }

    /**
     * 更改词条的状态。
     * Change the status of the entry.
     *
     * @param string $newStatus - 新的状态
     * @return void
     */
    public function changeStatus($newStatus)
    {
        $this->update(['status' => $newStatus]);
    }

    /**
     * Retrieve all associated walls for the entry.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function walls()
    {
        return $this->belongsToMany(Wall::class, 'entity_wall_association', 'entity_id', 'wall_id')
                    ->where('entity_type', 'entry');
    }

    /**
     * Retrieve the associated entity walls for the entry.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function EntityWallAssociations() {
        return $this->hasMany(EntityWallAssociation::class, 'entity_id')
                    ->where('entity_type', 'entry');
    }

    /**
     * 在 Entry 和 Wall 之间创建新的 EntityWallAssociation 链接。
     *
     * @param array $wallData 包含 Wall 信息的数组 (name, slug, description)
     * @return EntityWallAssociation 创建的关联实例
     */
    public function createEWLink($wallData) {
        $entityType = 'entry';
        $entityUuid = $this->id;

        return EntityWallAssociation::createNewWallAndLink($entityType, $entityUuid, $wallData);
    }

    /**
     * 获取此词条的公共分支。
     */
    public function communityBranch()
    {
        return $this->branches()->where('Is_PB', 0)->first();
    }

    public function albums()
    {
        return $this->morphToMany(Album::class, 'entity', 'entity_album_association');
    }

    public function EntityAlbumAssociations() {
        return $this->hasMany(EntityAlbumAssociation::class, 'entity_id')
                    ->where('entity_type', 'entry');
    }

    public function addEntityAlbumLink($album)
    {
        return EntityAlbumAssociation::addAELink($this, $album);
    }

    // 获取相关的 Node (DAG)
    public function nodes()
    {
        return $this->morphToMany(Node::class, 'entity', 'category_entity_association', 'entity_id', 'category_id');
    }

    // 获取相关的 Tree
    public function trees()
    {
        return $this->morphToMany(Tree::class, 'entity', 'category_entity_association', 'entity_id', 'category_id');
    }

    public function createCELink($category)
    {
        return CategoryEntityAssociation::create([
            'entity_id' => $this->id,
            'entity_type' => self::class,
            'category_id' => $category->id,
            'relationship_type' => 5,
            'category_type' => get_class($category)
            // 其他字段根据需要添加
        ]);
    }

    /**
     * --------------------------
     *  状态区域
     * --------------------------
     *  使用 Status trait
     *///
     //###
    /**
     * 检查Public是否可见
     * 
     * @return bool
     */
    public function isPublicVisible() {
        return $this->isPublicVisible_Entry($this->status);
    }

    /**
     * 检查Owner和Editor是否可见
     * 
     * @return bool
     */
    public function isOwnerAndEditorVisible() {
        return $this->isOwnerAndEditorVisible_Entry($this->status);
    }

    /**
     * 检查Owner是否可见
     * 
     * @return bool
     */
    public function isOwnerVisible() {
        return $this->isOwnerVisible_Entry($this->status);
    }

    /**
     * 检查Public是否可编辑
     * 
     * @return bool
     */
    public function isPublicEditable() {
        return $this->isPublicEditable_Entry($this->status);
    }

    /**
     * 检查Owner和Editor是否可编辑
     * 
     * @return bool
     */
    public function isOwnerAndEditorEditable() {
        return $this->isOwnerAndEditorEditable_Entry($this->status);
    }

    /**
     * 检查Owner是否可编辑
     * 
     * @return bool
     */
    public function isOwnerEditable() {
        return $this->isOwnerEditable_Entry($this->status);
    }

    /**
     * 获取审核状态
     * 
     * @return int
     */
    public function getCensorStatus() {
        return $this->censorStatus_Entry($this->status);
    }

    /**
     * 检查是否可以继承
     * 
     * @return bool
     */
    public function isInheritable() {
        return $this->isInheritable_Entry($this->status);
    }
}
