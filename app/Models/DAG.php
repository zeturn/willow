<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UUID;
use App\Traits\Status;

use App\Models\Node;
use App\Models\Edge;

/**
 * DAG 抽象层
 * 
 * 本抽象层不能作为对象
 * 
 */
class DAG extends Model
{
    use HasFactory, UUID, Status;

        /**
     * 根据给定的节点获取所有子节点。
     *
     * @param Node $node
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDescendants(Node $node)
    {
        return $node->whereHas('outgoingEdges', function ($query) use ($node) {
            $query->where('start_node', $node->id);
        })->get();
    }

    /**
     * 根据给定的节点获取所有父节点。
     *
     * @param Node $node
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAncestors(Node $node)
    {
        return $node->whereHas('incomingEdges', function ($query) use ($node) {
            $query->where('end_node', $node->id);
        })->get();
    }

}
