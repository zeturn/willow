<?php

namespace App\Livewire\Entry;

use Livewire\Component;
use App\Models\Entry;
use App\Models\EntryBranch;
use App\Models\EntryVersion;

class ShowBranchVersion extends Component
{
    public $entryId;
    public $entry;
    public $branches;
    public $versions;
    public $selectedBranchId;

    public function mount($entryId)
    {
        $this->entryId = $entryId;
        $this->branches = EntryBranch::where('entry_id', $this->entryId)->get();
        $this->entry = Entry::where('id', $this->entryId)->first();
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
            'demo_branch_id' => $this->entry->demo_branch_id,
            'is_pb' => 'is_pb',
        ]);
    }
}
