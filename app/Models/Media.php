<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // 如果您计划使用软删除
use App\Traits\UUID;
use App\Traits\Status;
use Illuminate\Support\Facades\Storage; // 引入 Storage 门面

class Media extends Model
{
    use SoftDeletes, UUID, Status; // 如果您计划使用软删除

    protected $fillable = ['url', 'status', 'user_id', 'description'];
    protected $table = 'medias'; // 显式指定表名

    /**
     * 更改状态。
     * Change the status of the entry.
     *
     * @param string $newStatus - 新的状态
     * @return void
     */
    public function changeStatus($newStatus)
    {
        $this->update(['status' => $newStatus]);
    }

    public function changeCensorStatus($newStatus){
        //需要根据实际状态调整
        $this->changeStatus($newStatus);

        return true;
    }

    public function getUrlAttribute($value)
    {
        // 返回媒体文件的完整 URL
        return asset("/storage/".$value);
    }

    public function user()
    {
        // 与 User 模型的一对多关系
        return $this->belongsTo(User::class);
    }

    public function deleteWithFile()
    {
    // 假设文件存储在 'public' 磁盘上
    $filePath = 'medias/' . basename($this->url); // 获取文件名并构建路径
    if (Storage::disk('public')->exists($filePath)) {
        Storage::disk('public')->delete($filePath);
    }

    //dd(Storage::disk('public')->exists($filePath));
    // 删除数据库记录
    $this->forceDelete();
    }
}
