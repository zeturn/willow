<?php

namespace App\Livewire\Branch;

use Livewire\Component;
use App\Models\Entry;
use App\Models\EntryBranch; // 确保引入了正确的模型

class EditorList extends Component
{
    public $branchId;
    public $entryBranch;
    public $users;
    public $owner;
    public $newUserId;

    public function mount($branchId)
    {
        //\Log::info("Received branchId: " . $branchId);
        $this->branchId = $branchId;
        $this->entryBranch = EntryBranch::find($this->branchId);

        $this->owner = $this->entryBranch->owner;
        $this->users = $this->entryBranch->users;
    }

    public function deleteEditor($userId)
    {
        // 删除用户逻辑
        // 可以使用 Laravel 的路由来处理

        $this->entryBranch->deleteUser($userId);

        //刷新
        $this->owner = $this->entryBranch->owner;
        $this->users = $this->entryBranch->users;
    }

    public function addEditor()
    {
        // 添加用户逻辑
        $this->entryBranch->addUser($this->newUserId);

        //刷新
        $this->owner = $this->entryBranch->owner;
        $this->users = $this->entryBranch->users;

        $this->newUserId = '';
    }

    public function render()
    {
        return view('livewire.branch.editor-list');
    }
}
