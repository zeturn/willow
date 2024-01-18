<?php
/**
 * 用于记录用户的正在进行中的编写任务 / Model for tracking user's ongoing writing tasks.
 * 
 * 这个模型用于处理与EntryVersion相关的任务 / This model is used to handle tasks related to EntryVersion.
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use App\Traits\Status;
use App\Models\EntryBranch; 
use App\Models\EntryVersion; // 确保引入了正确的模型 / Ensure the correct model is imported
use App\Models\EntryVersionTask;
use App\Models\CensorTask;

class EntryVersionTask extends Model
{
    use HasFactory;
    use UUID;
    use Status;

    protected $table = 'entry_version_tasks'; // 显式指定表名 / Explicitly specify the table name
    
    protected $fillable = [
        'name',
        'description',
        'content',
        'author_id',
        'status',
        'entry_id',
        'branch_id',
        'original_version_id',
    ];

    /**
     * 更改状态 / Change the status
     * 
     * 改变条目的状态 / Change the status of the entry.
     *
     * @param string $newStatus 新的状态 / New status
     * @return void
     */
    public function changeStatus($newStatus)
    {
        $this->update(['status' => $newStatus]);
    }

    /**
     * 更改审核状态 / Change censor status
     * 
     * 根据实际情况调整审核状态 / Adjust censor status according to actual circumstances.
     *
     * @param string $newStatus 新的审核状态 / New censor status
     */
    public function changeCensorStatus($newStatus)
    {
        $this->changeStatus($newStatus);
    }

    /**
     * 创建新版本 / Create new version
     * 
     * 生成一个新的条目版本 / Generate a new entry version.
     */
    public function VersionGeneration()
    {
        // 创建一个新的EntryVersion实例 / Create a new EntryVersion instance
        $newVersion = new EntryVersion([
            'entry_branch_id' => $this->branch_id,
            'name' => $this->name,
            'description' => $this->description,
            'content' => $this->content,
            'author_id' => $this->author_id,
            'status' => 5, // 假设5是要设置的状态 / Assuming 5 is the status to set
        ]);

        $newVersionStatus = $newVersion->save();
        $Branch = EntryBranch::where('id', $this->branch_id)->first(); // 获取单个实例 / Get a single instance

        if (!$Branch->demo_version_id) {
            $Branch->update(['demo_version_id' => $newVersion->id]);
        }

        if ($newVersionStatus) {
            $newcensortask = new CensorTask([
                'entity_type' => get_class($newVersion),
                'entity_id' => $newVersion->id,
                'status' => 6,
            ]);

            $newcensortask->save();
            $newcensortask->execute(); // 执行第一次尝试 / Execute the first attempt

            // 如果新版本保存成功 / If the new version is successfully saved
            if ($newVersion->save()) {
                // 软删除当前的EntryVersionTask / Soft delete the current EntryVersionTask
                $this->delete();
                // 如果保存新版本失败则返回 / Return if saving the new version fails
                return redirect()->route('entry.show.explanation', $this->entry_id);
            }
        }
    }
}
