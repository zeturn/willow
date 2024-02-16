<?php

namespace App\Livewire\Branch;

use Livewire\Component;
use App\Models\Entry;
use App\Models\EntryBranch;
use App\Models\User; // 引入用户模型
use App\Models\Team;

class TeamsList extends Component
{
    public $branchId;
    public $entryBranch;
    public $owner;
    public $teams;
    public $newTeamId;
    public $searchResult = null; // 用于存储搜索结果

    public function mount($branchId)
    {
        $this->branchId = $branchId;
        $this->entryBranch = EntryBranch::find($this->branchId);
        $this->owner = $this->entryBranch->owner;
        $this->teams = $this->entryBranch->teams;
    }

    public function updatedNewUserId($value)
    {
        // 检测输入值是不是UUID
        if (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i', $value)) {
            
            $this->searchResult =  ['type' => 'team', 'detail' => $value] ;
        } else {
            $this->searchResult = null;
        }
    }

    public function deleteTeam($teamId)
    {
        $this->entryBranch->deleteTeam($teamId);
        $this->owner = $this->entryBranch->owner;
    }

    public function addTeam()
    {
        $this->entryBranch->addTeam($this->newTeamId);
        $this->owner = $this->entryBranch->owner;
        $this->teams = $this->entryBranch->teams;
        $this->newTeamId = '';
    }

    public function render()
    {
        return view('livewire.branch.teams-list');
    }
}
