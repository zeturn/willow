<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UUID;
use App\Traits\Status;

class Wall extends Model
{
    use HasFactory, SoftDeletes, UUID, Status;

    public $incrementing = false; // 关闭自增属性
    protected $keyType = 'string'; // 主键不是整型

    protected $casts = [
        'id' => 'string', // 确保所有ID都是字符串类型
    ];

    protected $fillable = ['name', 'slug', 'description', 'status', 'eid'];

    //对应的entry
    public function entry()
    {
        return $this->belongsTo(Entry::class);
    }

    // 可搜索属性
    protected $searchable = ['name', 'description'];

    // 与Topic关联
    public function topics()
    {
        return $this->hasMany(Topic::class);
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
     * 返回相关联的墙
     * 
     * 
     * 
     */

    public function walls() {
        return $this->morphToMany(Wall::class, 'entity', 'entity_wall_association', 'entity_id', 'wall_id')
          ->withPivot('entity_type')
          ->wherePivot('entity_type', 'entry');
    }

    /**
     * 创建一个新的 Wall 实例。(重载)
     *
     * @param string $name
     * @param string $slug
     * @param string $description
     * @return Wall
     */
    public static function createNewWall($name, $slug, $description, $status) {

        $wall = new self();
        $wall->name = $name;
        $wall->slug = $slug;
        $wall->description = $description;
        $wall->status = $status;
        $wall->save();

        return $wall;
    }

    /**
     * Get links to all associated entities.
     *
     * @return array
     */
    public function getEntityLinks()
    {
        $entityLinks = [];
    
        foreach ($this->entityWallAssociations as $association) {
            $entity = $association->entity;
            if ($entity) {
                // 检查实体是否有 'name' 属性
                $entityName = $entity->name ?? $entity->getEntityName() . ' ' . $entity->id;
    
                $entityLinks[] = [
                    'name' => $entityName,
                    'link' => route($entity->getEntityName() . '.show', $entity->id)
                ];
            }
        }
    
        return $entityLinks;
    }
    

    // Relation to EntityWallAssociation (assuming this is already defined)
    public function entityWallAssociations()
    {
        return $this->hasMany(EntityWallAssociation::class, 'wall_id');
    }


    /**
     * --------------------------
     *  状态区域
     * --------------------------
     *  使用 Status trait
     *///
     //###
    /**
     * 检查Owner和Editor是否可见
     * 
     * @return bool
     */
    public function isOwnerAndEditorVisible() {
        return $this->isOwnerAndEditorVisible_Wall($this->status);
    }

    /**
     * 检查Owner是否可见
     * 
     * @return bool
     */
    public function isOwnerVisible() {
        return $this->isOwnerVisible_Wall($this->status);
    }

    /**
     * 检查Public是否可编辑
     * 
     * @return bool
     */
    public function isPublicEditable() {
        return $this->isPublicEditable_Wall($this->status);
    }

    /**
     * 检查Owner和Editor是否可编辑
     * 
     * @return bool
     */
    public function isOwnerAndEditorEditable() {
        return $this->isOwnerAndEditorEditable_Wall($this->status);
    }

    /**
     * 检查Owner是否可编辑
     * 
     * @return bool
     */
    public function isOwnerEditable() {
        return $this->isOwnerEditable_Wall($this->status);
    }

    /**
     * 获取审核状态
     * 
     * @return int
     */
    public function getCensorStatus() {
        return $this->censorStatus_Wall($this->status);
    }

    /**
     * 本文件结束
     * 
     */
}