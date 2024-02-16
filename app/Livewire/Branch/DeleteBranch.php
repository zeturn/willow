<?php

namespace App\Livewire\Branch;

use Livewire\Component;
use App\Models\Entry;
use App\Models\EntryBranch;
use App\Models\User; // 引入用户模型

class DeleteBranch extends Component
{
    public $owner;
    public $branchId;

    public $input_Modal = false;
    public $confirm_Modal = false;
    public $night_Modal = false;

    public $confirmMessage = '';

    public function mount($branchId)
    {
        $this->branchId = $branchId;
        $this->entryBranch = EntryBranch::find($this->branchId);
        $this->owner = $this->entryBranch->owner;

        $this->confirmMessage = $this->entryBranch->owner->name."/".$this->entryBranch->name;
    }


    public function render()
    {
        return view('livewire.branch.delete-branch');
    }
}
