<?php

namespace App\Livewire\Album;

use App\Models\Album;
use App\Models\Media;
use App\Models\AlbumsMediaAssociation;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
class AlbumCreator extends Component
{
    use WithFileUploads;
    public $title;
    public $photos = [];
    public $photoOrders = [];
    protected $rules = [
        'title' => 'required|string',
        'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
    ];
    public function updatedPhotos()
    {
        // 当用户选择新图片时，初始化排序数组
        $this->photoOrders = collect($this->photos)->pluck('name')->toArray();
    }
    public function save()
    {
        $this->validate();
        // 创建相册
        $album = Album::create([
            'title' => $this->title,
            'user_id' => auth()->id(),
            'list' => json_encode(['photos' => []]), // 初始化 JSON
            'status' => 1,
        ]);
        // 保存图片并更新 JSON
        foreach ($this->photos as$key => $photo) {
            $photoPath =$photo->store('photos', 'public');
            $media = Media::create([
                'url' => $photoPath,
                'user_id' => auth()->id(),
                'status' => 1,
            ]);
            AlbumsMediaAssociation::create([
                'album_id' => $album->id,
                'media_id' => $media->id,
            ]);
            // 更新 JSON 中的排序
            $this->photoOrders[$key] = ['name' => $photo->getClientOriginalName(), 'status' => 5, 'order' =>$key + 1];
        }
        // 更新相册的 JSON 字段
        $album->update(['list' => json_encode(['photos' =>$this->photoOrders])]);
        // session()->flash('message', 'Album created successfully!');
        return redirect()->route('albums.show', $album->id);
    }

    public function movePhoto($srcIndex,$dstIndex)
    {
        $srcPhoto =$this->photos[$srcIndex];
        $dstPhoto =$this->photos[$dstIndex];
        // 更新数组中的位置
        $this->photos[$srcIndex] = $dstPhoto;
        $this->photos[$dstIndex] = $srcPhoto;
        // 重新排序 photoOrders
        $this->photoOrders = array_values($this->photos);
        // 触发前端排序更新
        $this->dispatchBrowserEvent('photosSorted');
    }
    
    public function render()
    {
        return view('livewire.album.album-creator');
    }
}