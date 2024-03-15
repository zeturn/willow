<?php

namespace App\Livewire\Branch;

use Livewire\Component;
use App\Models\Entry;
use App\Models\EntryBranch;
use App\Models\EntryBranchUser;
use App\Models\EntryVersion;
use App\Models\EntryVersionTask;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class VersionEditPortal extends Component
{
    use WithPagination;
    
    public $entryId;
    public $branchId;
    public $versionId = null;
    public $branch;
    public $branches;
    public $versions;
    public $selectedVersion;
    public $author_id; // 确保这个属性是从某处赋值的，比如当前登录用户
    public $userEditable;

    public function mount($branchId)
    {
        $this->branchId = $branchId;
        $this->author_id = Auth::id();

        $this->loadVersions();
    }

    public function loadVersions()
    {
        $this->branch = EntryBranch::find($this->branchId);
        if($this->author_id){//是作者或可编辑
            $this->userEditable = $this->branch->userEditable(Auth::id());
            //dd($this->branch->userEditable(Auth::id()));
        }else{
            $this->userEditable = 0;
        }
        if ($this->branch) {
            $this->versions = $this->branch->versions; // 确保你的 EntryBranch 模型有一个 versions() 关系方法
        }
    }

    public function selectVersion($versionId)
    {
        $this->selectedVersion = $this->versions->where('id', $versionId)->first();
        $this->createTask();
    }

    public function deleteVersion($versionId)
    {
        // 找到对应的EntryVersion对象
        $version = EntryVersion::find($versionId);
    
        // 如果找到了对象，就删除它
        if ($version) {
            $version->delete();
            if ($this->branch) {
                $this->versions = $this->branch->versions; // 确保你的 EntryBranch 模型有一个 versions() 关系方法
            }
        }
    }
    

    public function createTask()
    {
        $task = new EntryVersionTask([
            'entry_id' => $this->branch->entry_id,
            'branch_id' => $this->branchId,
            'version_id' => null,
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
            'demo_version_id' => $this->branch->demo_version_id,
        ]);
    }
}
