<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Entry;
use App\Models\Album;
 // 确保引入正确的模型


class ShowAlbumsInEntry extends Component
{
    public $entryId;
    public $albums;
    public $newalbumId;
    //public $newalbum;

    public function mount($entryId)
    {
        $this->entryId = $entryId;
        $this->albums = Entry::find($this->entryId)->albums;
        //dd( $this->albums);
    }

    public function render()
    {
        return view('livewire.show-albums-in-entry');
    }

    public function addEntityAlbumLink()
    {
        // Find the album using the provided album ID
        $newAlbum = Album::find($this->newalbumId);
        if (!$newAlbum) {
            // Handle the case where the album is not found
            // You can also add a flash message or log this event
            return;
        }
    
        // Find the entry and check if it exists
        $entry = Entry::find($this->entryId);
        if (!$entry) {
            // Handle the case where the entry is not found
            // You can also add a flash message or log this event
            return;
        }
    
        // Link the album to the entry
        $entry->addEntityAlbumLink($newAlbum);
    
        // Refresh the albums list
        $this->albums = $entry->albums;
    
        // Reset newalbumId for the next input
        $this->newalbumId = null;
    }
    
    // In your Blade template, add an input field for newalbumId.
    // The form should submit to a route that calls this method.
    
}
//@livewire('show-albums-in-entry', ['entryId' => $entryId])
