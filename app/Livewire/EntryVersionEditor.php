<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\EntryVersion; // 确保引入了正确的模型
use App\Models\EntryVersionTask; // 确保引入了正确的模型
use App\Models\CensorTask;
use Illuminate\Support\Facades\Auth; // 引入 Auth facade

class EntryVersionEditor extends Component
{
    public $entryId;//所属词条
    public $branchId;//所属分支
    public $originalVersionId;//继承版本
    public $taskId;//编辑任务

    public $name;
    public $description;
    public $content; // 用于存储编辑内容
    public $author_id; // 用于存储当前用户的ID
    public $status;

    
    public function render()
    {
        return view('livewire.entry-version-editor');
    }

    public function mount($eveid)
    {
        //Auth::id(); // 设置当前用户的ID

        // 根据传入的 eveid 查找数据
        $entryVersionTask = EntryVersionTask::find($eveid);

        if ($entryVersionTask) {
            // 将找到的数据分配给组件的属性
            $this->taskId = $entryVersionTask->id;
            $this->entryId = $entryVersionTask->entry_id;
            $this->branchId = $entryVersionTask->branch_id;
            $this->originalVersionId = $entryVersionTask->original_version_id;
            $this->name = $entryVersionTask->name;
            $this->description = $entryVersionTask->description;
            $this->content = $entryVersionTask->content;
            $this->author_id = $entryVersionTask->author_id;
            $this->status = $entryVersionTask->status;
        }
        // 如果需要，可以在这里处理未找到数据的情况
    }

    public function startTask($entryId, $branchId, $originalVersionId = null)
    {
        // 首先给三个变量赋值
        $this->entryId = $entryId;
        $this->branchId = $branchId;
        $this->originalVersionId = $originalVersionId;
    
        if ($originalVersionId) {
            // 直接从 EntryVersion 模型中获取原始版本的数据
            $originalVersion = EntryVersion::find($originalVersionId);
    
            if ($originalVersion) {
                // 创建新的 EntryVersionTask 实例并填充数据
                $task = new EntryVersionTask();
                $task->entry_id = $this->entryId;
                $task->branch_id = $this->branchId;
                $task->original_version_id = $this->originalVersionId;
                $task->author_id = Auth::id(); // 从原始版本复制
                $task->name = $originalVersion->name; // 从原始版本复制
                $task->description = $originalVersion->description; // 从原始版本复制
                $task->content = $originalVersion->content; // 从原始版本复制
                $task->status = $originalVersion->status; // 从原始版本复制
    
                $task->save(); // 保存新任务到数据库
    
                // 更新组件的公共变量
                $this->name = $task->name;
                $this->description = $task->description;
                $this->content = $task->content;
                $this->author_id = $task->author_id;
                $this->status = $task->status;
            }
        }
    }
    

    public function autoSave()
    {
        if ($this->entryId) {
            // 找到当前的 EntryVersionTask 实例
            $task = EntryVersionTask::where('id', $this->taskId)
                                    ->first();
    
            if ($task) {
                // 更新 task 实例
                $task->name = $this->name;
                $task->description = $this->description;
                $task->content = $this->content;
                $task->author_id = $this->author_id;
                $task->status = $this->status;
    
                $task->save(); // 保存更改

                // 可以添加一些反馈给用户，比如设置一个消息或重定向
                session()->flash('message', '更改已成功推送。');
            }
        }
    }
    

    public function push()
    {
        if ($this->entryId) {
            $task = EntryVersionTask::where('id', $this->taskId)
            ->first();

            //设置状态
            if ($task) {
                // 创建新的版本，你可能需要在这里添加更多字段
                if($this->status == 5){
                    $task->status = 6;
                }elseif($this->status == 7){
                    $task->status = 8;
                }else{//10
                    $task->status = 11;
                }
                $task->save(); 
            }

            $task->VersionGeneration();

            // 任务完成后的逻辑，例如重置组件状态、通知用户等
            // ...
        }
    }
}
