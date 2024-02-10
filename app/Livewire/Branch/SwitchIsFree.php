<?php

namespace App\Livewire\Branch;

use Livewire\Component;
use App\Models\EntryBranch;

class SwitchIsFree extends Component
{
    public $entryBranchId;
    public $isFree = false;

    public function mount($entryBranchId)
    {
        $this->entryBranchId = $entryBranchId;
        $entryBranch = EntryBranch::find($this->entryBranchId);
        $this->isFree = $entryBranch->is_free;
    }

    public function toggleIsFree()
    {
        $entryBranch = EntryBranch::find($this->entryBranchId);
        $entryBranch->is_free = !$entryBranch->is_free;
        $entryBranch->save();
        $this->isFree = $entryBranch->is_free;
    }

    public function render()
    {
        return view('livewire.branch.switch-is-free');
    }
}
