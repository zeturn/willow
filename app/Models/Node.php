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
     * 为当前词条创建审核
     * Create Censor Task for this entry.
     * 
     * @param 
     * @return CensorTask $censorTask - 新创建的Task
     */
    public function createCensorTask(){
        return $censorTask = CensorTask::create([
            'entity_type' => 'Node',
            'entity_id' => $this->id,
            'status' => 6,
        ]);
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

        // 与起点为当前节点的边的关系
        public function edgesAsStart()
        {
            return $this->hasMany(Edge::class, 'start_node');
        }
    
        // 与终点为当前节点的边的关系
        public function edgesAsEnd()
        {
            return $this->hasMany(Edge::class, 'end_node');
        }
    
    /**
     * 获取与当前节点邻接的所有节点和边的状态
     * Get all adjacent nodes and the status of edges connected to the current node
     * 此方法返回当前节点所有邻接节点及其边的状态。它考虑了异常情况，如数据库查询失败或返回空值。
     * This method returns all adjacent nodes and the status of their edges. It handles exceptions such as database query failures or null returns.
     * @return array 返回包含邻接节点和边状态的数组/Returns an array containing adjacent nodes and edge status
     */
    public function getAdjacentNodesAndEdges()
    {
        $adjacentNodesAndEdges = [];

        // 尝试获取以当前节点为起点的边，处理潜在的查询异常
        // Attempt to retrieve edges with the current node as the start, handling potential query exceptions
        try {
            $edgesAsStart = $this->edgesAsStart()->with('endNode')->get();
        } catch (\Exception $e) {
            // 查询失败时返回错误信息
            // Return an error message if the query fails
            return ['error' => 'Failed to retrieve edges as start node'];
        }

        // 检查结果是否为非空数组
        // Check if the result is a non-empty array
        if (!empty($edgesAsStart)) {
            foreach ($edgesAsStart as $edge) {
                // 检查边和邻接节点是否存在
                // Check if edge and adjacent node exist
                if ($edge && $edge->endNode) {
                    $adjacentNodesAndEdges[] = [
                        'adjacent_node' => $edge->endNode, // 邻接节点 / Adjacent node
                        'edge_status' => $edge->status, // 边的状态 / Edge status
                    ];
                }
            }
        }

        // 尝试获取以当前节点为终点的边，处理潜在的查询异常
        // Attempt to retrieve edges with the current node as the end, handling potential query exceptions
        try {
            $edgesAsEnd = $this->edgesAsEnd()->with('startNode')->get();
        } catch (\Exception $e) {
            // 查询失败时返回错误信息
            // Return an error message if the query fails
            return ['error' => 'Failed to retrieve edges as end node'];
        }

        // 检查结果是否为非空数组
        // Check if the result is a non-empty array
        if (!empty($edgesAsEnd)) {
            foreach ($edgesAsEnd as $edge) {
                // 检查边和邻接节点是否存在
                // Check if edge and adjacent node exist
                if ($edge && $edge->startNode) {
                    $adjacentNodesAndEdges[] = [
                        'adjacent_node' => $edge->startNode, // 邻接节点 / Adjacent node
                        'edge_status' => $edge->status, // 边的状态 / Edge status
                    ];
                }
            }
        }

        return $adjacentNodesAndEdges;
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
