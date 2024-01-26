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
    *--------------------------
    * 状态区
    *--------------------------
    */
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

    public function approveCensorTask()
    {
        return $this->censorTask()->update(['status' => 5]);
    }

    public function rejectCensorTask()
    {
        return $this->censorTask()->update(['status' => 7]);
    }

    public function waitCensorTask()
    {
        return $this->censorTask()->update(['status' => 6]);
    }

    /**
    *--------------------------
    * 关联区
    *--------------------------
    */

    public function entry()
    {
        return $this->entity_type === 'Entry' ? $this->belongsTo(Entry::class, 'entity_id') : null;
    }

    public function branch()
    {
        return $this->entity_type === 'EntryBranch' ? $this->belongsTo(EntryBranch::class, 'entity_id') : null;
    }

    public function version()
    {
        return $this->entity_type === 'EntryVersion' ? $this->belongsTo(EntryVersion::class, 'entity_id') : null;
    }

    public function VersionTask()
    {
        return $this->entity_type === 'EntryVersionTask' ? $this->belongsTo(EntryVersionTask::class, 'entity_id') : null;
    }

    public function task()
    {
        return $this->entity_type === 'EntryVersionTask' ? $this->belongsTo(EntryVersionTask::class, 'entity_id') : null;
    }

    public function wall()
    {
        return $this->entity_type === 'Wall' ? $this->belongsTo(Wall::class, 'entity_id') : null;
    }

    public function topic()
    {
        return $this->entity_type === 'Topic' ? $this->belongsTo(Topic::class, 'entity_id') : null;
    }

    public function comment()
    {
        return $this->entity_type === 'Comment' ? $this->belongsTo(Comment::class, 'entity_id') : null;
    }

    public function media()
    {
        return $this->entity_type === 'Media' ? $this->belongsTo(Media::class, 'entity_id') : null;
    }

    public function album()
    {
        return $this->entity_type === 'Album' ? $this->belongsTo(Album::class, 'entity_id') : null;
    }
}
