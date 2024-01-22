<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UUID;
use App\Traits\Status;

class CensorTask extends Model
{
    use HasFactory, SoftDeletes, UUID, Status;

    protected $fillable = [
        'entity_type', 
        'entity_id', 
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


    public function execute()
    {
        // Dynamically resolve the class from entity_type 获取实体类型
        $className = $this->entity_type;

        //当不存在报错
        if (!class_exists($className)) {
            // Handle the case where the class does not exist
            return false;
        }

        // Find the entity using the class name and entity_id 获取实体
        $entity = $className::find($this->entity_id);

        //当不存在报错
        if (!$entity) {
            // Handle the case where the entity is not found
            return false;
        }
       
        // Check if the entity has the changeStatus method 检查是否有所需功能
        if (!method_exists($entity, 'changeCensorStatus')) {
            // Handle the case where the method does not exist
            return false;
        }

        // Execute the  method
        $result = $entity->changeCensorStatus(1550);

        // If VersionGeneration returns true, update the status of the task to 10
        if ($result === true) {
            $this->status = 10;//当前审核记录为5
            $this->save();
            return true;
        }

        return false;
    }
}
