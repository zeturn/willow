<?php

namespace App\Livewire\Entry;

use Livewire\Component;
use App\Models\Entry;
use App\Models\EntryBranch;

class EntryExplain extends Component
{
    public $branches = [];
    public $entryId;
    public $entry;
    public $page = 1;
    public $perPage = 5;
    public $totalBranches;
    public $hasMoreBranches = true;


    public function mount($entryId)
    {
        $this->entryId = $entryId;
        $this->entry = Entry::where('id', $this->entryId)->first();
        $this->loadBranches();
    }

    public function loadMoreBranches()
    {
        $this->page++;
        $this->loadBranches();
    }
    private function loadBranches()
    {
        $skip = ($this->page - 1) * $this->perPage;

        // 获取所有entry_id为$entryId的EntryBranch模型的总数
        $this->totalBranches = EntryBranch::where('entry_id',$this->entryId)->count();
        // 获取新的一页数据
        $newBranches = EntryBranch::where('entry_id',$this->entryId)
                                   ->skip($skip)
                                   ->take($this->perPage)
                                   ->get();
        // 将新数据追加到现有数组中
        $this->branches = array_merge($this->branches, $newBranches->all());

        if (count($this->branches) >= $this->totalBranches) {
            $this->hasMoreBranches = false;
        }
    }

    public function render()
    {
        return view('livewire.entry.entry-explain');
    }


}
