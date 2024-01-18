<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UUID;
use App\Traits\Status;

class CategoryEntityAssociation extends Model
{
    use HasFactory, SoftDeletes, UUID, Status;

    protected $table = 'category_entity_association';

    protected $guarded = [];  // 没有受保护的字段
    public $incrementing = false;  // 主键不是自增长的
    protected $keyType = 'string'; // 主键类型为字符串
    
    protected $fillable = [
        'category_id', 
        'category_type', 
        'entity_id', 
        'entity_type', 
        'relationship_type', 
        'status'
    ];

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

    // 定义与 Node 的多态关系
    public function node()
    {
        return $this->morphedByMany(Node::class, 'category', 'category_entity_associations');
    }

    // 定义与 Tree 的多态关系
    public function tree()
    {
        return $this->morphedByMany(Tree::class, 'category', 'category_entity_associations');
    }

    // 定义与 Entry 的多态关系
    public function entry()
    {
        return $this->morphedByMany(Entry::class, 'entity', 'category_entity_associations');
    }

    // 创建链接的方法
    public static function createCELink($entity, $category)
    {
        return self::create([
            'entity_id' => $entity->id,
            'entity_type' => get_class($entity),
            'category_id' => $category->id,
            'category_type' => get_class($category),
            'status' => 5,
            // 如果需要，可以设置其他字段，例如 'relationship_type' 和 'status'
        ]);
    }
}
