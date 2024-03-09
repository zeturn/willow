<?php

namespace App\Livewire\Entry;

use Livewire\Component;
use App\Models\Entry;
use App\Models\EntryBranch;
use App\Models\EntryBranchUser;
use App\Models\EntryVersion;
use App\Models\EntryVersionTask;
use Illuminate\Support\Facades\Auth;

/**
 * 编辑门户组件 / Edit Portal Component
 *
 * 用于编辑条目的Livewire组件 / Livewire component for editing entries.
 */
class EditPortal extends Component
{
    public $step = 1; // 当前步骤 / Current step
    public $entryId; // 当前Entry的ID / Current Entry ID
    public $branchId; // 目标分支ID / Target Branch ID
    public $inheritBranchId; // 继承分支ID / Inherited Branch ID
    public $originalVersionId; // 原始版本ID / Original Version ID 
    public $branches = []; // 分支列表 / List of branches
    public $versions = []; // 版本列表 / List of versions
    public $selectedVersion; // 选中的版本 / Selected version
    public $entry; // 当前条目 / Current entry
    public $name; // 名称 / Name
    public $description; // 描述 / Description
    public $content; // 内容 / Content
    public $author_id; // 作者ID / Author ID
    public $status; // 状态 / Status
    public $taskId; // 任务ID / Task ID
    public $isCreatingNewBranch = false; // 是否正在创建新分支 / Is creating a new branch

    /**
     * 挂载方法 / Mount method
     * 
     * 用于初始化组件状态的方法 / Method for initializing component state.
     *
     * @param int $entryId Entry的ID / Entry ID
     */
    public function mount($entryId)
    {
        $this->entryId = $entryId;
        $this->entry = Entry::find($entryId);
        $this->author_id = Auth::id();
    }

    /**
     * 渲染视图 / Render view
     * 
     * 返回编辑门户视图 / Returns the edit portal view.
     *
     * @return \Illuminate\View\View 视图 / View
     */
    public function render()
    {
        return view('livewire.entry.edit-portal');
    }

    /**
     * 选择分支和版本 / Choose branch and version
     * 
     * 用户选择要编辑的分支和版本 / User selects the branch and version to edit.
     *
     * @param bool $isCreatingNewBranch 是否创建新分支 / Whether to create a new branch
     */
    public function chooseBranchAndVersion($isCreatingNewBranch = false)
    {
        $this->isCreatingNewBranch = $isCreatingNewBranch;
        $this->branches = EntryBranch::where('entry_id', $this->entryId)->get();
        $this->step = $isCreatingNewBranch ? 3 : 2;
    }

    /**
     * 选择目标分支 / Select target branch
     * 
     * 用户选择目标分支 / User selects the target branch.
     *
     * @param int $branchId 分支ID / Branch ID
     */
    public function selectTargetBranch($branchId)
    {
        $this->branchId = $branchId;
        $this->step = 3;
    }

    /**
     * 选择继承分支 / Select inherit branch
     * 
     * 用户选择继承的分支 / User selects the branch to inherit from.
     *
     * @param int $branchId 分支ID / Branch ID
     */
    public function selectInheritBranch($branchId)
    {
        $this->inheritBranchId = $branchId;
        $this->versions = EntryVersion::where('entry_branch_id', $branchId)->get();
        $this->step = 4;
    }

    /**
     * 选择版本 / Select version
     * 
     * 用户选择要编辑的版本 / User selects the version to edit.
     *
     * @param int $versionId 版本ID / Version ID
     */
    public function selectVersion($versionId)
    {
        $this->originalVersionId = $versionId;
        $this->selectedVersion = EntryVersion::find($versionId);
        $this->step = 5;
    }

    /**
     * 从头开始 / Start from scratch
     * 
     * 用户决定从头开始创建新分支或版本 / User decides to start creating a new branch or version from scratch.
     */
    public function startFromScratch()
    {
        if ($this->isCreatingNewBranch) {
            $this->branchId = null;
            $this->inheritBranchId = null;
        }
        $this->step = 5;
    }

    /**
     * 开始任务 / Start task
     * 
     * 用户开始编辑任务 / User starts the editing task.
     *
     * @return \Illuminate\Routing\Redirector 重定向到编辑器 / Redirect to the editor
     */
    public function startTask()
    {
        $task = new EntryVersionTask();

        if ($this->isCreatingNewBranch) {
            // 创建新分支 / Creating a new branch
            $task->status = 5;
            $newBranch = new EntryBranch();
            $newBranch->entry_id = $this->entryId;
            $newBranch->demo_version_id = null;
            $newBranch->is_pb = false;
            $newBranch->is_free = false;
            $newBranch->status = 5;
            $newBranch->save();
            $this->branchId = $newBranch->id;

            EntryBranchUser::newOwner($newBranch->id, Auth::id());

        } else {
            // 获取继承分支 / Get inherit branch
            $inheritBranch = EntryBranch::where('id', $this->branchId)->first();
            if ($inheritBranch && $inheritBranch->is_pb) {
                $task->status = 7;
            } else {
                $task->status = 10;
            }
        }

        $task->entry_id = $this->entryId;
        $task->branch_id = $this->branchId;
        $task->version_id = null;
        $task->original_version_id = $this->originalVersionId;
        $task->author_id = $this->author_id;
        $task->name = $this->selectedVersion ? $this->selectedVersion->name : $this->entry->name;
        $task->description = $this->selectedVersion ? $this->selectedVersion->description : '';
        $task->content = $this->selectedVersion ? $this->selectedVersion->content : '';

        $task->save();
        $this->taskId = $task->id;
        return redirect()->route('entry.version.editor', ['editorId' => $this->taskId]);
    }

    /**
     * 返回上一步 / Go back
     * 
     * 用户返回到上一步操作 / User goes back to the previous step.
     */
    public function goBack()
    {
        if ($this->step > 1) {
            if ($this->isCreatingNewBranch) {
                if ($this->step == 5) {
                    if ($this->originalVersionId) {
                        $this->step = 4;
                    } else {
                        $this->step = 3;
                    }
                } elseif ($this->step == 3) {
                    $this->step = 1;
                }
            } else {
                $this->step--;
            }
        }

        if ($this->step == 3) {
            $this->originalVersionId = null;
            $this->selectedVersion = null;
        }
    }
}
