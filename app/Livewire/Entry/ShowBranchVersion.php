<?php

namespace App\Livewire\Entry;

use Livewire\Component;
use App\Models\EntryBranch;
use App\Models\EntryVersion;

class ShowBranchVersion extends Component
{
    public $entryId;
    public $branches;
    public $versions;
    public $selectedBranchId;

    public function mount($entryId)
    {
        $this->entryId = $entryId;
        $this->branches = EntryBranch::where('entry_id', $this->entryId)->get();
    }

    public function loadVersions($branchId)
    {
        $this->selectedBranchId = $branchId;
        $this->versions = EntryVersion::where('entry_branch_id', $this->selectedBranchId)->get();
                //dd($this->versions);
    }

    public function updatedSelectedBranchId($branchId)
    {
        $this->versions = EntryVersion::where('entry_branch_id', $branchId)->get();

    }

    public function render()
    {
        return view('livewire.entry.show-branch-version', [
            'branches' => $this->branches,
            'versions' => $this->versions,
        ]);
    }
}
