<?php

namespace App\Traits;

trait Status {
    
    /**
     * 查询status指定位上的数字 / Find the digit at the specified position in a number
     * 
     * @param int $num 原始数字 / Original number
     * @param int $p 位置 / Position
     * @return int|null 位上的数字或者null（如果位置无效） / Digit at the position or null (if the position is invalid)
     */
    function findDigit($num, $p) {
        // 验证输入是否为整数 / Validate if inputs are integers
        if (!is_int($num) || !is_int($p)) {
            // 输入类型错误 / Input type incorrect
            return null;
        }

        $numStr = strval($num);

        // 验证位置是否有效 / Validate if the position is valid
        if ($p > strlen($numStr) || $p <= 0) {
            // 位置无效 / Position invalid
            return null;
        }

        // 返回指定位置的数字 / Return the digit at the specified position
        return (int)$numStr[strlen($numStr) - $p];
    }

    /**
     * 更改指定位数上的数字 / Change the digit at the specified position in a number
     * 
     * @param int $num 原始数字 / Original number
     * @param int $p 位置 / Position
     * @param int $newDigit 新的数字 / New digit
     * @return int|null 更改后的数字或者null（如果位置或新数字无效） / Modified number or null (if the position or new digit is invalid)
     */
    function changeDigit($num, $p, $newDigit) {
        // 验证输入是否为整数 / Validate if inputs are integers
        if (!is_int($num) || !is_int($p) || !is_int($newDigit)) {
            // 输入类型错误 / Input type incorrect
            return null;
        }

        $numStr = strval($num);

        // 验证位置和新数字是否有效 / Validate if the position and new digit are valid
        if ($p > strlen($numStr) || $p <= 0 || $newDigit < 0 || $newDigit > 9) {
            // 位置或新数字无效 / Position or new digit invalid
            return null;
        }

        // 从右向左修改数字 / Modify the digit from right to left
        $numStr[strlen($numStr) - $p] = strval($newDigit);

        // 返回修改后的数字 / Return the modified number
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

    /**
     * --------------------------
     * Media系列 状态区域
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
    public function isPublicVisible_Media($status){

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
    public function isOwnerAndEditorVisible_Media($status){
        
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
    public function isOwnerVisible_Media($status){
        
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
    public function isPublicEditable_Media($status){

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
    public function isOwnerAndEditorEditable_Media($status){
        
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
    public function isOwnerEditable_Media($status){
        
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
    public function censorStatus_Media($status){
        return $this->findDigit($status,3);
    }

}

