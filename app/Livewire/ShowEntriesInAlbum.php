<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Album; // 确保引入正确的模型

class ShowEntriesInAlbum extends Component
{
    public $albumId;
    public $entries;
    public $isVisible;

    public function mount($albumId)
    {
        $this->albumId = $albumId;
        $this->entries = Album::find($this->albumId)->entries;
        //dd($this->entries);
    }

    public function render()
    {
        return view('livewire.show-entries-in-album');
    }

    public function toggleVisibility()
    {
        $this->isVisible = !$this->isVisible;
    }

    public function addEntityAlbumLink($entity)
    {
        // 这里可以添加你的逻辑来创建链接
    }
}

//@livewire('show-entries-in-album', ['albumId' => $albumId])
