<?php

namespace App\Traits;

trait Status {
    
    /**
     * 查询status指定位上的数字
     * 
     * @param int $num 原始数字
     * @param int $p 位置
     * @return int|null 位上的数字或者null（如果位置无效）
     */
    function findDigit($num, $p) {
        $numStr = strval($num);
    
        if ($p > strlen($numStr) || $p <= 0) {
            // 位置无效
            return null;
        }
    
        return $numStr[strlen($numStr) - $p];
    }

    /**
     * 更改指定位数上的数字
     * 
     * @param int $num 原始数字
     * @param int $p 位置
     * @param int $newDigit 新的数字
     * @return int|null 更改后的数字或者null（如果位置或新数字无效）
     */
    function changeDigit($num, $p, $newDigit) {
        $numStr = strval($num);

        if ($p > strlen($numStr) || $p <= 0 || $newDigit < 0 || $newDigit > 9) {
            // 位置或新数字无效
            return null;
        }

        // 从右向左修改数字
        $numStr[strlen($numStr) - $p] = strval($newDigit);

        return intval($numStr);
    }

    /**
     * --------------------------
     * Entry系列 状态区域
     * --------------------------
     *///
     //
    /**
     * Public是否可见
     * 
     * 
     * @param int $status
     * @return bool
     */
    public function isPublicVisible_Entry($status){

        if($this->findDigit($status,1) == 5){
            return true;            
        }else{
            return false;
        }

    }

    /**
     * Owner和 Editor是否可见
     * 
     * 
     * @param int
     * @return bool
     */
    public function isOwnerAndEditorVisible_Entry($status){
        
        if($this->findDigit($status,1) == 5||$this->findDigit($status,1) == 7){
            return true;            
        }else{
            return false;
        }
    }

    /**
     * Owner是否可见
     * 
     * 
     * @param int
     * @return bool
     */
    public function isOwnerVisible_Entry($status){
        
        if($this->findDigit($status,1) == 5|| $this->findDigit($status,1) == 7 || $this->findDigit($status,1) == 6){
            return true;            
        }else{
            return false;
        }
    }

    /**
     * Public是否可编辑
     * 
     * 
     * @param int $status
     * @return bool
     */
    public function isPublicEditable_Entry($status){

        if($this->findDigit($status,2) == 5){
            return true;            
        }else{
            return false;
        }

    }

    /**
     * Owner和 Editor是否可编辑
     * 
     * 
     * @param int $status
     * @return bool
     */
    public function isOwnerAndEditorEditable_Entry($status){
        
        if($this->findDigit($status,2) == 5||$this->findDigit($status,2) == 7){
            return true;            
        }else{
            return false;
        }
    }

    /**
     * Owner是否可编辑
     * 
     * 
     * @param int $status
     * @return bool
     */
    public function isOwnerEditable_Entry($status){
        
        if($this->findDigit($status,2) == 5|| $this->findDigit($status,2) == 7 || $this->findDigit($status,2) == 6){
            return true;            
        }else{
            return false;
        }
    }
    

    /**
     * 返回审核状态
     * 
     * 
     * @param int $status
     * @return int
     */
    public function censorStatus_Entry($status){
        return $this->findDigit($status,3);
    }

    /**
     *  返回是否可以继承
     * 
     * @param int $status 
     * @return bool
     */
    public function isInheritable_Entry($status){

        if($this->findDigit($status,4) == 2){
            return true;            
        }else{
            return false;
        }
    }

    /**
     *  返回是否为demo version
     * 
     * @param int $status 
     * @return bool
     */
    public function isDemoVersion_Entry($status){

        if($this->findDigit($status,5) == 2){
            return true;            
        }else{
            return false;
        }
    }

    /**
     * --------------------------
     * Discuss（wall）系列 状态区域
     * --------------------------
     *///
     //
    /**
     * Public是否可见
     * 
     * 
     * @param int $status
     * @return bool
     */
    public function isPublicVisible_Wall($status){

        if($this->findDigit($status,1) == 5){
            return true;            
        }else{
            return false;
        }

    }

    /**
     * Owner和 Editor是否可见
     * 
     * 
     * @param int
     * @return bool
     */
    public function isOwnerAndEditorVisible_Wall($status){
        
        if($this->findDigit($status,1) == 5||$this->findDigit($status,1) == 7){
            return true;            
        }else{
            return false;
        }
    }

    /**
     * Owner是否可见
     * 
     * 
     * @param int
     * @return bool
     */
    public function isOwnerVisible_Wall($status){
        
        if($this->findDigit($status,1) == 5|| $this->findDigit($status,1) == 7 || $this->findDigit($status,1) == 6){
            return true;            
        }else{
            return false;
        }
    }

    /**
     * Public是否可编辑
     * 
     * 
     * @param int $status
     * @return bool
     */
    public function isPublicEditable_Wall($status){

        if($this->findDigit($status,1) == 5){
            return true;            
        }else{
            return false;
        }

    }

    /**
     * Owner和 Editor是否可编辑
     * 
     * 
     * @param int $status
     * @return bool
     */
    public function isOwnerAndEditorEditable_Wall($status){
        
        if($this->findDigit($status,1) == 5||$this->findDigit($status,1) == 7){
            return true;            
        }else{
            return false;
        }
    }

    /**
     * Owner是否可编辑
     * 
     * 
     * @param int $status
     * @return bool
     */
    public function isOwnerEditable_Wall($status){
        
        if($this->findDigit($status,1) == 5|| $this->findDigit($status,1) == 7 || $this->findDigit($status,1) == 6){
            return true;            
        }else{
            return false;
        }
    }
    

    /**
     * 返回审核状态
     * 
     * 
     * @param int $status
     * @return int
     */
    public function censorStatus_Wall($status){
        return $this->findDigit($status,3);
    }

}

