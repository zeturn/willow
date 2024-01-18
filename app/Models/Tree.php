<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UUID;
use App\Traits\Status;

class Tree extends Model
{
    use HasFactory, SoftDeletes, UUID, Status;

    protected $guarded = [];  // 没有受保护的字段
    public $incrementing = false;  // 主键不是自增长的
    protected $keyType = 'string'; // 主键类型为字符串

    protected $fillable = ['name', 'parent_id', 'description', 'status'];

    public function getEntityName() {
        return 'trees';
    }
    
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
    
    /**
     * 获取父分类。
     */
    public function parent()
    {
        return $this->belongsTo(Tree::class, 'parent_id');
    }

    /**
     * 获取子分类。
     */
    public function children()
    {
        return $this->hasMany(Tree::class, 'parent_id');
    }

        /**
     * 获取关联的墙
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function walls()
    {
        return $this->belongsToMany(Wall::class, 'entity_wall_association', 'entity_id', 'wall_id')
                    ->where('entity_type', 'tree'); // 注意这里的 entity_type 值
    }

    /**
     * 获取关联的 EntityWallAssociation 实例
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function EntityWallAssociations() {
        return $this->hasMany(EntityWallAssociation::class, 'entity_id')
                    ->where('entity_type', 'tree'); // 注意这里的 entity_type 值
    }

    /**
     * 创建并关联新的 Wall 实例到 Tree 实体。
     *
     * @param Request $request 请求对象
     * @param string  $treeUuid Tree 实体的 UUID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createEWLink($wallData) {
        $entityType = 'tree';
        $entityUuid = $this->id;

        return EntityWallAssociation::createNewWallAndLink($entityType, $entityUuid, $wallData);
    }

    // 获取相关的 Entry
    public function entries()
    {
        return $this->morphToMany(Entry::class, 'category', 'category_entity_association', 'category_id', 'entity_id');
    }

    public function createCELink($entry)
    {
        return CategoryEntityAssociation::create([
            'category_id' => $this->id,
            'category_type' => self::class,
            'entity_id' => $entry->id,
            'relationship_type' => 5,
            'entity_type' => get_class($entry)
            // 其他字段根据需要添加
        ]);
    }
}
