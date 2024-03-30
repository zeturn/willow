<?php

namespace App\Livewire\Explore;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Entry;

class EntryWaterfall extends Component
{

    public $entries = [];

    public function mount()
    {
        $this->loadEntries();
    }

    public function loadEntries()
    {
        // 这里用伪代码表示，您需要替换为实际的数据获取逻辑
        $entries = Entry::inRandomOrder()->limit(50)->get();
        $this->entries = array_merge($this->entries, $entries->all());
    }

    public function loadMoreEntries()
    {
        $this->loadEntries();
    }

    public function render()
    {
        return view('livewire.explore.entry-waterfall');
    }
}