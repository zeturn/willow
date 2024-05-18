<?php
namespace App\Livewire\Favorite;

use Livewire\Component;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AddToFavorite extends Component
{
    public $modelType;
    public $modelId;
    public $favorites;
    public $selectedFavorites;
    public $newFavoriteName;//新收藏夹的名称
    public $newFavoriteDescription;//新收藏夹的描述
    public $showModal = false;//是否显示模态框
    public $showCreateFavorite = false;//是否显示创建收藏夹视图

    public $message = '';

    public function mount($modelType, $modelId)
    {
        $this->modelType = $modelType;
        $this->modelId = $modelId;
        $this->favorites = Auth::user()->favorites()->get();
    }

    public function addToFavorite($favoritesId)
    {
        // 获取用户选择的收藏夹
        $favorite = Favorite::findOrFail($favoritesId);
    
        // 构建新的收藏项
        $newFavorite = [
            'model_type' => $this->modelType,
            'model_id' => $this->modelId
        ];
    
        // 从数据库中获取当前的收藏夹JSON数据
        $favoritesJson =$favorite->favorites;
    
        // 将新的收藏项添加到数组中
        $favoritesArray = json_decode($favoritesJson, true);
        $favoritesArray[] =$newFavorite;
    
        // 更新收藏夹的JSON字段
        $favorite->favorites = json_encode($favoritesArray);
        $favorite->save();

        $this->message = '已成功添加到收藏夹'.$favorite?->name;
    }

    public function createFavorite()
    {
        $newFavorite = new Favorite();
        $newFavorite->name = $this->newFavoriteName;
        $newFavorite->description = $this->newFavoriteDescription;
        $newFavorite->favorites = json_encode([]);
        $newFavorite->status = 5;
        $newFavorite->save();

        // 将新的收藏夹添加到用户收藏夹中
        $user = User::findOrFail(Auth::id());
        $user->favorites()->attach($newFavorite->id);

        $this->favorites = Auth::user()->favorites()->get();
        $this->showCreateFavorite = false;

        $this->message = '已成功创建收藏夹';
        $this->render();
    }

    public function openCreateFavorite()
    {
        $this->showCreateFavorite = true;
    }

    public function closeCreateFavorite()
    {
        $this->showCreateFavorite = false;
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function reset_comp(){
        $this->message = '';
        
        $this->newFavoriteName = '';
        $this->newFavoriteDescription = '';

        $this->showModal = false;
        $this->showCreateFavorite = false;

        $this->render();
    }

    public function render()
    {
        return view('livewire.favorite.add-to-favorite');
    }
}
