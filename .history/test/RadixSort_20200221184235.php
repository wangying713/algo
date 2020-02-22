<?php
/**
 * 基数排序
 *  排个位，十位，百位
 */
class RadixSort
{

    public static function sort(&$nums){
        
        $max = count($nums);
        $maxCount = strlen($max);
        for ($i=0; $i < $maxCount; $i++) { 
            static::radixSort($nums, $i);
        }
    }

    protected static function radixSort(&$nums, $loop)
    {
        $count = count($nums);
        $divisor = pow(10, $loop);
        for($i=0; $i<$count; $i++) {
            $index = ($nums[$i]/$divisor)%10;
            var_dump($index);
        }


    }

}

