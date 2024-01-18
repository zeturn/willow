<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UUID;
use App\Traits\Status;

class Node extends Model
{
    use HasFactory, SoftDeletes, UUID, Status;

    protected $guarded = [];  // 没有受保护的字段
    public $incrementing = false;  // 主键不是自增长的
    protected $keyType = 'string'; // 主键类型为字符串

    protected $fillable = ['name', 'description', 'status'];

    public function getEntityName() {
        return 'nodes';
    }

    public function changeStatus($newStatus){
        $this->update(['status' => $newStatus]);
    }

    public function changeCensorStatus($newStatus){
        //需要根据实际状态调整
        $this->changeStatus($newStatus);

        return true;
    }

    /**
     * 获取从此节点出发的边。
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function outgoingEdges()
    {
        return $this->hasMany(Edge::class, 'start_node');
    }

    /**
     * 获取到达此节点的边。
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function incomingEdges()
    {
        return $this->hasMany(Edge::class, 'end_node');
    }

    /**
     * 获取关联的墙
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function walls()
    {
        return $this->belongsToMany(Wall::class, 'entity_wall_association', 'entity_id', 'wall_id')
                    ->where('entity_type', 'node'); // 注意这里的 entity_type 值
    }

    /**
     * 获取关联的 EntityWallAssociation 实例
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function EntityWallAssociations() {
        return $this->hasMany(EntityWallAssociation::class, 'entity_id')
                    ->where('entity_type', 'node'); // 注意这里的 entity_type 值
    }

    /**
     * 在 Node 和 Wall 之间创建新的 EntityWallAssociation 链接。
     *
     * @param array $wallData 包含 Wall 信息的数组 (name, slug, description)
     * @return EntityWallAssociation 创建的关联实例
     */
    public function createEWLink($wallData) {
        // 确定 Node 的类型和 UUID
        $entityType = 'node'; // Node 实体的类型标识
        $entityUuid = $this->id; // 假设 Node 实体有一个 id 字段

        // 调用 EntityWallAssociation 来创建新的 Wall 并建立链接
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
