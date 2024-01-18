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

}

