<?php

namespace App\Livewire\Album;

use App\Models\Album;
use App\Models\Media;
use App\Models\AlbumsMediaAssociation;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class AlbumEditor extends Component
{
    use WithFileUploads;
    public $album_title;
    public $album_id;
    public $photos = [];//上传用
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
                'name' => Str::random(40) . '.' . $photo->getClientOriginalExtension(), // 生成唯一文件名,//可以作为老图片的名称
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
        $album = Album::where('id', $this->album_id)->first();

        // 删除所有与当前专辑ID相关的媒体关联
        AlbumsMediaAssociation::where('album_id', $this->album_id)->delete();
        $order = 1;
        // 处理 photo_list 中的图片并创建 Media 对象
        $mediaList = [];
        foreach ($this->photo_list as $photo) {

            if($photo['is_new']){
                
                //新储存照片
                $url = $photo['ori_photo']->storeAs('photos', $photo['name'], 'public'); 
                //创建媒体对象               
                $media = Media::create([
                    'url' => $url,
                    'user_id' => auth()->id(),
                    'status' => 1, // 设置状态或其他必要字段
                ]);

            }else{
                $media = Media::where('url', 'photos/'.$photo['name'])->first();
            }



            //创建链接
            AlbumsMediaAssociation::create([
                'album_id' => $this->album_id,
                'media_id' => $media->id,
            ]);

            $mediaList[] = [
                'name' => $photo['name'],
                'status' => 5,
                'order' => $order,
            ];

            $order = $order + 1;
        }
        // 更新相册的 list 字段
        $album->update(['list' => json_encode($mediaList)]);

        session()->flash('message', 'Album创建成功！');
        return redirect()->route('albums.show', $this->album_id);
    }

    public function mount()
    {
        $this->photo_list = []; // 初始化 photo_list
        $album = Album::where('id', $this->album_id)->first();
        
        if ($album) {
            $old_album = json_decode($album->list, true); // 解码为数组
    
            // 确保$old_album是数组并且里面有元素
            if (is_array($old_album) && !empty($old_album)) {
                // 为每个元素添加'url'键
                foreach ($old_album as $key => $photo) {
                    if (is_array($photo)) { // 确保每个元素也是数组
                        $old_album[$key]['url'] = '/storage/photos/' . $photo['name'];
                        $old_album[$key]['is_new'] = false;
                    }
                }
            }
    
            $this->photo_list = $old_album;
            $this->album_title = $album->title;
        }

    }

    public function render()
    {
        return view('livewire.album.album-editor');
    }
}
