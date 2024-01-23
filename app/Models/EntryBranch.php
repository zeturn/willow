<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use App\Traits\Status;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntryBranch extends Model
{
    use HasFactory; // 使用Laravel的工厂功能，帮助创建假数据
    use UUID; // 使用UUID trait，可能用于生成UUID作为主键
    use SoftDeletes; // 使用软删除功能
    use Status;
    
    protected $guarded = []; // 没有受保护的字段，这意味着所有字段都可以被批量赋值
    public $incrementing = false; // 主键不自增
    protected $keyType = 'string'; // 主键的数据类型是字符串
    protected $fillable = ['id', 'entry_id', 'demo_version_id', 'is_pb', 'is_free', 'status']; // 可以批量赋值的字段

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
     * 为当前词条分支创建审核
     * Create Censor Task for this branch.
     * 
     * @param 
     * @return CensorTask $censorTask - 新创建的Task
     */
    public function createCensorTask(){
        return $censorTask = CensorTask::create([
            'entity_type' => 'Branch',
            'entity_id' => $this->id,
            'status' => 5,
        ]);
    }

    public function censorTasks()
    {
        return $this->hasMany(CensorTask::class, 'entity_id')
                    ->where('entity_type', 'Branch');
    }

    public function Entry()
    {
        return $this->belongsTo(Entry::class);
    }

    

    /**
     * 获取分支下所有的版本。
     * Get all versions under this branch.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function versions() {
        return $this->hasMany(EntryVersion::class, 'entry_branch_id', 'id');
    }

    public function demoVersion()
    {
        return $this->hasOne(EntryVersion::class, 'id', 'demo_version_id');
    }

    public function versionsforreview()
    {
        // 这里使用 where 条件来过滤 status 为 7 的版本
        return $this->versions()->where('status', 1550);
    }

    /**
     * 获取该词条的 Demo Version。
     * Get the demo version of this entry.
     * @return \App\Models\EntryVersion|null
     */
    public function getDemoVersion() {
        return $this->belongsTo(EntryVersion::class, 'demo_version_id', 'id')->first();
    }

    /**
     * 更改该词条的 Demo Version。
     * Change the demo version of this entry.
     * @param string $newDemoVersionId
     * @return void
     */
    public function changeDemoVersion($newDemoVersionId) {
        $this->update(['demo_version_id' => $newDemoVersionId]);
    }
    
    /**
     * 检查特定用户是否有编辑该分支的权限。
     * Check if a specific user has permission to edit this branch.
     * @param \App\Models\User $user
     * @return bool
     */
    public function isEditableBy($user) {
        return $this->users->contains($user->id);
    }
 
    /**
     * 获取分支的所有者。
     * Get the owner of the branch.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function owner() {
        return $this->belongsToMany(User::class, 'entry_branch_users', 'entry_branch_id', 'user_id')
                    ->where('role', 1);
    }
    public function getOwnerAttribute() {
        return $this->owner()->first();
    }
    

    /**
     * 获取有权限编辑该分支的用户。
     * Get all users with permission to edit this branch.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users() {
        return $this->belongsToMany(User::class, 'entry_branch_users', 'entry_branch_id', 'user_id')
                    ->where('role', 2);
    }
    public function getUsersAttribute() {
        return $this->users()->get();
    }

    /**
     * 允许BO添加新的用户到分支。
     * Allow BO to add new users to the branch.
     * @param int $userId
     * @param int $role
     * @return \App\Models\EntryBranchUser
     */
    public function addUser($userId, $role = 2) {
        return EntryBranchUser::create([
            'entry_branch_id' => $this->id,
            'user_id' => $userId,
            'role' => $role
        ]);
    }

    public function deleteUser($userId)
    {
        // Assuming $this->id is available in this context and represents the entry_branch_id
        $entryBranchId = $this->id;
    
        // Delete the record from EntryBranchUser where entry_branch_id and user_id match
        EntryBranchUser::where('entry_branch_id', $entryBranchId)
                       ->where('user_id', $userId)
                       ->delete();
    
        // Optionally, add more logic here if needed, like returning a response or redirecting
    }
    

    /**
     * 根据UUID获取用户在分支上的角色。
     * Get the user's role on the branch by UUID.
     * @param string $uuid
     * @return int
     */
    public function getUserRoleByUuid(string $uuid): int {
        $branchUser = $this->users()->where('user_id', $uuid)->first();
        return $branchUser ? $branchUser->role : 0; // 返回0如果用户没有在这个分支上的角色
    }
    
    /**
     * Retrieve all associated walls for the entry branch.
     * 获取关联的墙
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * 返回 Wall
     */
    public function walls()
    {
        return $this->belongsToMany(Wall::class, 'entity_wall_association', 'entity_id', 'wall_id')
                    ->where('entity_type', 'entryBranch');
    }

    /**
     * Retrieve the associated entity walls for the entry.
     * 获取关联的数据
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * 返回EntityWallAssociation
     */
    public function EntityWallAssociations() {
        return $this->hasMany(EntityWallAssociation::class, 'entity_id')
                    ->where('entity_type', 'entryBranch');
    }

    /**
     * 在 Branch 和 Wall 之间创建新的 EntityWallAssociation 链接。
     *
     * @param array $wallData 包含 Wall 信息的数组 (name, slug, description)
     * @return EntityWallAssociation 创建的关联实例
     */
    public function createEWLink($wallData) {
        $entityType = 'entryBranch';
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
