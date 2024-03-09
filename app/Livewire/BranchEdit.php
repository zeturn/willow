<?php

namespace App\Livewire;
 
use Livewire\Component;
use App\Models\Entry;
use App\Models\EntryBranch; // 假设您的模型命名如此
use App\Models\EntryVersion;
use App\Models\EntryVersionTask;
use Illuminate\Support\Facades\Auth; // 引入 Auth facade

class BranchEdit extends Component
{
    public $step = 1;//1.开始 2.修改主分支：选择分支 3.修改主分支：选择版本 4.创建新分支：选择分支 5.创建新分支：选择版本
    public $versions = [];
    public $branches = [];
    public $selectedVersion;
    public $entryId;
    public $branchId;
    public $originalVersionId;
    public $entry;

    
    public $name;
    public $description;
    public $content; // 用于存储编辑内容g
    public $author_id; // 用于存储当前用户的ID
    public $status;

    public $taskId;

    public function mount($entryId)
    {

        $this->entryId = $entryId;

        $entry = Entry::find($entryId);
        // 你可能需要加载一些初始数据...
    }

    public function render()
    {
        return view('livewire.branch-edit');
    }

    /**
     * 步骤2
     * 
     * 
     */
    public function loadPublicBranchVersions()
    {
        $entry = Entry::find($this->entryId);
        if ($entry) {
            $communityBranch = $entry->communityBranch();
            $this->branchId = $communityBranch->id;
            if ($communityBranch) {
                $this->versions = $communityBranch->versions; // 假设版本与分支之间的关系名为 'versions'
            }
        }
        $this->step = 2;
    }

    public function createNewBranch()
    {
        $entry = Entry::find($this->entryId);
        if ($entry) {
            $this->branches = $entry->branches; // 获取所有分支
        }
        $this->step = 4;
    }

    public function selectBranch($branchId)
    {

        $branch = EntryBranch::find($branchId);
        if ($branch) {
            $this->versions = $branch->versions()->get(); // 获取选定分支的所有版本
        }

        $this->branchId = $branchId;        
        $this->step = 5;
    }


    public function selectVersion($versionId)
    {
        $this->selectedVersion = EntryVersion::find($versionId);
        $this->originalVersionId = $versionId;
    }

    public function startTask()
    {
    
        if ($this->originalVersionId) {
            // 直接从 EntryVersion 模型中获取原始版本的数据
            $originalVersion = EntryVersion::find($this->originalVersionId);
    
            if ($originalVersion) {
                // 创建新的 EntryVersionTask 实例并填充数据
                $task = new EntryVersionTask();
                $task->entry_id = $this->entryId;
                $task->branch_id = $this->branchId;
                $task->version_id = null;//创建新的task时，不会有对应的version
                $task->original_version_id = $this->originalVersionId;
                $task->author_id = Auth::id(); // 从原始版本复制
                $task->name = $originalVersion->name; // 从原始版本复制
                $task->description = $originalVersion->description; // 从原始版本复制
                $task->content = $originalVersion->content; // 从原始版本复制
                $task->status = $originalVersion->status; // 从原始版本复制
    
                $task->save(); // 保存新任务到数据库
    
                // 更新组件的公共变量
                $this->name = $task->name;
                $this->description = $task->description;
                $this->content = $task->content;
                $this->author_id = $task->author_id;
                $this->status = $task->status;

                $this->taskId = $task->id;

                return redirect()->route('entry.version.editor', ['editorId' => $this->taskId]);
            }
        }
    }
    


}
