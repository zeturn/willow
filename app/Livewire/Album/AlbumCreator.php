<?php

namespace App\Livewire\Album;

use App\Models\Album;
use App\Models\Media;
use App\Models\AlbumsMediaAssociation;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
class AlbumCreator extends Component
{
    use WithFileUploads;
    public $album = [
        'title' => '',
        'user_id' => '', // 需要根据实际情况设置用户ID
        'list' => '',
        'status' => 1,
    ];
    public $photos = [];
    public $photo_list = [];

    public function updatedPhotos()
    {
        $this->validate([
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
        ]);
        foreach ($this->photos as $photo) {
            // 创建临时 URL 用于预览
            $temporaryUrl =$photo->temporaryUrl();
            // 将图片信息追加到 photo_list
            $this->photo_list[] = [
                'name' => $photo->getClientOriginalName(),//可以作为老图片的名称
                'ori_photo' => $photo,
                'url' => $temporaryUrl,
                'temp_path' => $photo->getRealPath(),
                'order' => count($this->photo_list) + 1,
                'is_new' => true,
                'ori_id' => '',
            ];
        }
        // 清空 photos 属性，以便用户可以上传新的图片
        $this->photos = [];
    }

    public function moveUp($index)
    {
        if ($index > 0) {
            $previousIndex =$index - 1;
            $temp =$this->photo_list[$previousIndex];
            $this->photo_list[$previousIndex] = $this->photo_list[$index];
            $this->photo_list[$index] = $temp;
            // 强制组件重新渲染
            $this->render();
        }
    }
    public function moveDown($index)
    {
        if ($index < count($this->photo_list) - 1) {
            $nextIndex =$index + 1;
            $temp =$this->photo_list[$nextIndex];
            $this->photo_list[$nextIndex] = $this->photo_list[$index];
            $this->photo_list[$index] = $temp;
            // 强制组件重新渲染
            $this->render();
        }
    }

    public function removePhoto($index)
    {
        unset($this->photo_list[$index]);
        $this->photo_list = array_values($this->photo_list);
    }

    //提交图片
    public function saveAlbum()
    {

        // 创建相册
        $album = Album::create([
            'title' => $this->album['title'],
            'user_id' => auth()->id(), // 确保已登录用户
            'status' => $this->album['status'],
        ]);

        // 处理 photo_list 中的图片并创建 Media 对象
        $mediaList = [];
        foreach ($this->photo_list as $photo) {
            $url = $photo['ori_photo']->store('photos', 'public');
            if($photo ['is_new']){
                $media = Media::create([
                    'url' => $url,
                    'user_id' => auth()->id(),
                    'status' => 1, // 设置状态或其他必要字段
                ]);
            }else{
                $media = Media::where('name', $photo->ori_id)->first();
            }


            AlbumsMediaAssociation::create([
                'album_id' => $album->id,
                'media_id' => $media->id,
            ]);

            $mediaList[] = [
                'name' => $photo['name'],
                'status' => 5,
                'order' => $photo['order'],
            ];
        }
        // 更新相册的 list 字段
        $album->update(['list' => json_encode($mediaList)]);
        session()->flash('message', 'Album创建成功！');
        return redirect()->route('albums.show', $album->id);
    }

    public function mount()
    {
        $this->photo_list = []; // 初始化 photo_list
    }

    public function render()
    {
        return view('livewire.album.album-creator');
    }
}
