<?php

namespace App\Livewire\Branch;

use Livewire\Component;
use App\Models\Entry;
use App\Models\EntryBranch;
use App\Models\EntryBranchUser;
use App\Models\EntryVersion;
use App\Models\EntryVersionTask;
use Illuminate\Support\Facades\Auth;

class VersionEditPortal extends Component
{
    public $entryId;
    public $branchId;
    public $branch;
    public $branches;
    public $versions;
    public $selectedVersion;
    public $author_id; // 确保这个属性是从某处赋值的，比如当前登录用户

    public function mount($branchId)
    {
        $this->branchId = $branchId;
        $this->author_id = Auth::id();
        $this->loadVersions();
    }

    public function loadVersions()
    {
        $this->branch = EntryBranch::find($this->branchId);

        if ($this->branch) {
            $this->versions = $this->branch->versions; // 确保你的 EntryBranch 模型有一个 versions() 关系方法
        }
    }

    public function selectVersion($versionId)
    {
        $this->selectedVersion = $this->versions->where('id', $versionId)->first();
        $this->createTask();
    }

    public function createTask()
    {
        $task = new EntryVersionTask([
            'entry_id' => $this->branch->entry_id,
            'branch_id' => $this->branchId,
            'original_version_id' => $this->selectedVersion->id,
            'author_id' => $this->author_id,
            'name' => $this->selectedVersion->name,
            'description' => $this->selectedVersion->description,
            'content' => $this->selectedVersion->content,
            'status' => 1401113177,//词条 任务 全部 预留 预留 预留 不可评论 预留 仅编辑 仅可见
        ]);

        $task->save();
        return redirect()->route('entry.version.editor', ['editorId' => $task->id]);
    }

    public function render()
    {
        return view('livewire.branch.version-edit-portal', [
            'versions' => $this->versions,
        ]);
    }
}
