<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use App\Traits\Status;

class EntityWallAssociation extends Model
{
    use UUID;
    use Status;
    public $incrementing = false; // 使用非递增的UUID作为主键
    protected $keyType = 'string'; // 主键类型为字符串

    protected $table = 'entity_wall_association'; // 自定义表名
    protected $fillable = ['entity_id', 'entity_type', 'wall_id', 'status']; // 可批量赋值的属性

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
     * 关联到Wall模型。
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function wall() {
        return $this->belongsTo(Wall::class, 'wall_id');
    }

    /**
     * ------------------------------
     * 以下为实体多对多注册区
     * ------------------------------
     */

    /**
     * 多对多多态关系定义：Wall与Entry。
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphedByMany
     */
    public function entries() {
        return $this->morphedByMany(Entry::class, 'entity', 'entity_wall_association');
    }

    /**
     * 多对多多态关系定义：Wall与Branch。
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphedByMany
     */
    public function branches() {
        return $this->morphedByMany(EntryBranch::class, 'entity', 'entity_wall_association');
    }

    /**
     * 多对多多态关系定义：Wall与Version。
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphedByMany
     */
    public function versions() {
        return $this->morphedByMany(EntryVersion::class, 'entity', 'entity_wall_association');
    }

    /**
     * 多对多多态关系定义：Wall 与 Edge。
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphedByMany
     */
    public function edges() {
        return $this->morphedByMany(Edge::class, 'entity', 'entity_wall_association');
    }

    /**
     * 多对多多态关系定义：Wall 与 Node。
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphedByMany
     */
    public function nodes() {
        return $this->morphedByMany(Node::class, 'entity', 'entity_wall_association');
    }

    /**
     * 多对多多态关系定义：Wall 与 Tree。
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphedByMany
     */
    public function trees() {
        return $this->morphedByMany(Tree::class, 'entity', 'entity_wall_association');
    }


    /**
     * 
     * 
     * 
     */

    /**
     * 根据 entity_type 返回对应的关联模型。
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entity() {
        switch ($this->entity_type) {
            case 'entry':
                return $this->belongsTo(Entry::class, 'entity_id');
            case 'entryBranch':
                return $this->belongsTo(EntryBranch::class, 'entity_id');
            case 'entryVersion':
                return $this->belongsTo(EntryVersion::class, 'entity_id');
            case 'edge':
                return $this->belongsTo(Edge::class, 'entity_id');
            case 'node':
                return $this->belongsTo(Node::class, 'entity_id');
            case 'tree':
                return $this->belongsTo(Tree::class, 'entity_id');
            // 其他可能的关联类型
            // ...
        }
    }

    /**
     * 创建一个新的 Wall 实例并建立与实体的关联。
     *
     * @param string $entityType 实体类型 ('dag', 'edge', 'node', 'tree', ...)
     * @param string $entityUuid 实体UUID
     * @param array  $wallData   包含 Wall 信息的数组 (name, slug, description)
     * @return EntityWallAssociation 创建的关联实例
     */
    public static function createNewWallAndLink($entityType, $entityUuid, $wallData) {
        // 创建 Wall 实例

        $newWall = Wall::createNewWall($wallData['name'], $wallData['slug'], $wallData['description'], 5);

        // 创建与实体的关联
        return self::createEWLink($entityType, $entityUuid, $newWall->id, 5); // 假设初始状态为 5
    }

    /**
     * 创建一个新的Entity和Wall之间的关联链接。
     *
     * @param string $entityType 实体类型 ('entry', 'branch', 'version', ...)
     * @param string $entityUuid 实体UUID
     * @param int    $wallId     Wall的ID
     * @param string $status     关联的状态
     * @return EntityWallAssociation 创建的关联实例
     */
    public static function createEWLink($entityType, $entityId, $wallId, $status) {
        // 创建并保存新的关联记录
        $link = new self();
        $link->entity_type = $entityType;
        $link->entity_id = $entityId;//uuid
        $link->wall_id = $wallId;//uuid
        $link->status = $status;
        $link->save();

        return $link;
    }


}
//如果代码跑起来了，那就不要再去动他