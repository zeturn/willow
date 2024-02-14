<?php

namespace App\Livewire\Branch;

use Livewire\Component;
use App\Models\Entry;
use App\Models\EntryBranch;
use App\Models\User; // 引入用户模型

class EditorList extends Component
{
    public $branchId;
    public $entryBranch;
    public $users;
    public $owner;
    public $teams;
    public $newUserId;
    public $searchResult = null; // 用于存储搜索结果

    public function mount($branchId)
    {
        $this->branchId = $branchId;
        $this->entryBranch = EntryBranch::find($this->branchId);
        $this->owner = $this->entryBranch->owner;
        $this->users = $this->entryBranch->users;
        $this->teams = $this->entryBranch->teams;
    }

    public function updatedNewUserId($value)
    {
        // 检测输入值是UUID还是邮箱
        if (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i', $value)) {
            // UUID搜索逻辑
            $this->searchResult =  ['type' => 'user', 'detail' => $value] ;
        } elseif (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            // 邮箱搜索逻辑
            $this->searchResult = ['type' => 'email', 'detail' => $value];
        } else {
            $this->searchResult = null;
        }
    }

    public function deleteEditor($userId)
    {
        $this->entryBranch->deleteUser($userId);
        $this->owner = $this->entryBranch->owner;
        $this->users = $this->entryBranch->users;
    }

    public function addEditor()
    {
        $this->entryBranch->addUser($this->newUserId);
        $this->owner = $this->entryBranch->owner;
        $this->users = $this->entryBranch->users;
        $this->newUserId = '';
    }

    public function render()
    {
        return view('livewire.branch.editor-list', ['searchResult' => $this->searchResult]);
    }
}
