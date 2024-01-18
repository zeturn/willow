<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use App\Traits\Status;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\EntryBranch;
use App\Models\EntryBranchUser;
use Illuminate\Database\Eloquent\Collection;

/**
 * Role 代码
 * 1.Owner（所有者主持人）
 * 2.Editor （编辑者）
 * 3.Viewer （观众）
 */
class EntryBranchUser extends Model
{
    use HasFactory;
    use UUID;
    use SoftDeletes;
    use Status;

    protected $guarded = [];// No protected fields.
    public $incrementing = false;// Not auto-incrementing.
    protected $keyType = 'string';
    protected $fillable = ['id', 'entry_branch_id', 'user_id', 'role']; // Fillable fields.

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
     * Returns the branch associated with the user.
     * 返回这个用户关联的分支。
     */
    public function branch()
    {
        return $this->belongsTo(EntryBranch::class, 'entry_branch_id', 'id');
    }

    /**
     * Create a new owner record for the user.
     * 为用户创建一个新的 owner 记录。
     *
     * @param string $BranchId Branch ID.
     * @param string $UserId User ID.
     * @return EntryBranchUser Created owner record.
     */
    public static function newOwner($BranchId, $UserId)
    {
        return self::create([
            'entry_branch_id' => $BranchId,
            'user_id' => $UserId,
            'role' => 1
        ]);
    }

    /**
     * 坏了
     * 
     * Get all branches that the user owns under a specific entry.
     * 获取当前用户所持有的当前词条下的所有分支。
     *
     * @param int $userId User ID.
     * @param int $entryId Entry ID.
     * @return Collection User-owned branches.
     * 
     * 特别注释：这段代码通过`EntryBranch`模型直接查询和返回那些与指定`entryId`关联且具有指定`userId`的用户权限的分支。它首先根据分支中是否存在给定的`userId`进行筛选，然后再筛选那些与给定`entryId`关联的分支，从而有效地从数据库中获取了结果。📘🌟
     * 它有很可能会坏
     * 坏了的话用这段 ->
     *         $entry = Entry::find($entryId); if (!$entry) { return collect([]); } $allBranches = $entry->branches; $userBranches = $allBranches->filter(function ($branch) use ($userId) {  return $branch->users()->where('User_ID', $userId)->exists();});  return $userBranches;
     */
    public static function UsersBranches($userId, $entryId): Collection
    {

        return EntryBranch::whereHas('users', function ($query) use ($userId) {
                $query->where('user_id', $userId);
                })
                ->where('entry_id', $entryId)
                ->get();
    }

    /**
     * Retrieve all branches that a specific user owns.
     * 获取当前用户持有的所有分支。
     *
     * @param int $userId User ID.
     * @return Collection User-owned branches.
     */
    public function allBranchesForUser($userId)
    {
        return $this->where('user_id', $userId)->get();
    }

    /**
     * Modify the role of a user.
     * 更改用户状态。
     *
     * @param int $userId User ID.
     * @param int $role Role code (1=Owner, 2=Editor, 3=Viewer).
     * @return int Number of records updated.
     */
    public function changeUserRole($userId, $role)
    {
        return $this->where('user_id', $userId)->update(['role' => $role]);
    }

    /**
     * Change the owner of a branch.
     * 更改分支所有者。
     *
     * @param int $originalOwnerId Original Owner ID.
     * @param int $branchId Branch ID.
     * @param int $newOwnerId New Owner ID.
     * @return int Number of records updated.
     */
    public function changeBranchOwner($originalOwnerId, $branchId, $newOwnerId)
    {
        return $this->where(['user_id' => $originalOwnerId, 'entry_branch_id' => $branchId, 'role' => 1])
                    ->update(['user_id' => $newOwnerId]);
    }

    /**
     * Remove the relationship of a user and a branch, excluding the owner.
     * 删除用户关系（不包括拥有者）。
     *
     * 所有者删除需要经过其他方法
     * 
     * @param int $userId User ID.
     * @param int $branchId Branch ID.
     * @return int Number of records deleted.
     */
    public function deleteUserRelationship($userId, $branchId)
    {
        return $this->where('user_id', $userId)
                    ->where('entry_branch_id', $branchId)
                    ->where('role', '<>', 1)
                    ->delete();
    }

    /**
     * Retrieve the role of a user in relation to a branch.
     * 获取用户的权限。
     *
     * @param int $userId User ID.
     * @param int $branchId Branch ID.
     * @return int Role code (1=Owner, 2=Editor, 3=Viewer).
     */
    public function userRole($userId, $branchId)
    {
        return $this->where('user_id', $userId)
                    ->where('entry_branch_id', $branchId)
                    ->pluck('role')
                    ->first();
    }

    /**
     * Check if the user is the owner of a branch.
     * 检查用户是否是某个分支的主持人（拥有者）。
     *
     * @param int $branchId Branch ID.
     * @return bool True if the user is the owner, false otherwise.
     */
    public function isOwnerOfBranch($branchId)
    {
        return $this->where('entry_branch_id', $branchId)->where('role', 1)->exists();
    }
}
