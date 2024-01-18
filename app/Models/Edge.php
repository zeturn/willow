<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UUID;
use App\Traits\Status;

class Edge extends Model
{
    use HasFactory, SoftDeletes, UUID, Status;

    protected $guarded = [];  // 没有受保护的字段
    public $incrementing = false;  // 主键不是自增长的
    protected $keyType = 'string'; // 主键类型为字符串

    protected $fillable = ['start_node', 'end_node', 'status'];

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
    
    public function getEntityName() {
        return 'edges';
    }
    
    /**
     * 获取起始节点。
     */
    public function startNode()
    {
        return $this->belongsTo(Node::class, 'start_node');
    }

    /**
     * 获取结束节点。
     */
    public function endNode()
    {
        return $this->belongsTo(Node::class, 'end_node');
    }

    /**
     * 获取关联的墙
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function walls()
    {
        return $this->belongsToMany(Wall::class, 'entity_wall_association', 'entity_id', 'wall_id')
                    ->where('entity_type', 'edge'); // 注意这里的 entity_type 值
    }

    /**
     * 获取关联的 EntityWallAssociation 实例
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function EntityWallAssociations() {
        return $this->hasMany(EntityWallAssociation::class, 'entity_id')
                    ->where('entity_type', 'edge'); // 注意这里的 entity_type 值
    }

    /**
     * 创建并关联新的 Wall 实例到 Edge 实体。
     *
     * @param Request $request 请求对象
     * @param string  $edgeUuid Edge 实体的 UUID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createEWLink($wallData) {
        $entityType = 'edge';
        $entityUuid = $this->id;

        return EntityWallAssociation::createNewWallAndLink($entityType, $entityUuid, $wallData);
    }
}
