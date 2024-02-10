<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use App\Traits\Status;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class EntryVersion extends Model
{
    use HasFactory;
    use UUID;
    use SoftDeletes;
    use Status;
    use Searchable;

    public $incrementing = false; // 不自增
    protected $keyType = 'string';  // 主键的数据类型是字符串
    protected $fillable = ['id', 'entry_branch_id', 'name', 'description', 'content', 'author_id', 'status']; // 可以批量赋值的字段
    protected $primaryKey = 'id';

    public function getEntityName() {
        return 'entry.version';
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
            'name' => $this->name,
            'description' => $this->description,
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
     * 为当前版本创建审核
     * Create Censor Task for this version.
     * 
     * @param 
     * @return CensorTask $censorTask - 新创建的Task
     */
    public function createCensorTask(){
        return $censorTask = CensorTask::create([
            'entity_type' => 'EntryVersion',
            'entity_id' => $this->id,
            'status' => 6,
        ]);
    }

    public function censorTasks()
    {
        return $this->hasMany(CensorTask::class, 'entity_id')
                    ->where('entity_type', 'Version');
    }

    /**
     * 返回这个版本属于哪个分支。
     * Get the branch this version belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch()
    {
        return $this->belongsTo(EntryBranch::class, 'entry_branch_id', 'id');
    }

    /**
     * 返回这个版本的作者。
     * Get the author of this version.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    /**
     * Retrieve all associated walls for the entry version.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function walls()
    {
        return $this->belongsToMany(Wall::class, 'entity_wall_association', 'entity_id', 'wall_id')
                    ->where('entity_type', 'entryVersion');
    }

    /**
     * Retrieve the associated entity walls for the entry verison.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function EntityWallAssociations() {
        return $this->hasMany(EntityWallAssociation::class, 'entity_id')
                    ->where('entity_type', 'entryVersion');
    }

    /**
     * 在 Version 和 Wall 之间创建新的 EntityWallAssociation 链接。
     *
     * @param array $wallData 包含 Wall 信息的数组 (name, slug, description)
     * @return EntityWallAssociation 创建的关联实例
     */
    public function createEWLink($wallData) {
        $entityType = 'entryVersion';
        $entityUuid = $this->id;

        return EntityWallAssociation::createNewWallAndLink($entityType, $entityUuid, $wallData);
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

    /**
     * 检查是否为demo version
     * 
     * @return bool
     */
    public function isDemoVersion() {
        return $this->isDemoVersion_Entry($this->status);
    } 
}
