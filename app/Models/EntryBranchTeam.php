<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use App\Traits\Status;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntryBranchTeam extends Model
{
    use HasFactory;
    use UUID;
    use SoftDeletes;
    use Status;

    protected $guarded = [];// No protected fields.
    public $incrementing = false;// Not auto-incrementing.
    protected $keyType = 'string';
    protected $fillable = ['id', 'entry_branch_id', 'team_id', 'role']; // Fillable fields.

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
    public static function newOwner($BranchId, $TeamId)
    {
        return self::create([
            'entry_branch_id' => $BranchId,
            'user_id' => $TeamId,
            'role' => 1
        ]);
    }

    /**
     * 不一定好使
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
    public static function TeamsBranches($teamId, $entryId): Collection
    {

        return EntryBranch::whereHas('teams', function ($query) use ($teamId) {
                    $query->where('team_id', $teamId);
                })
                ->where('entry_id', $entryId)
                ->get();
    }


}
