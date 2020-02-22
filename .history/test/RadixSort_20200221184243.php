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
$numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20];
$size = 10;
$rs = buckerSort($numbers); //加载了quickSort文件，请忽略前几个打印

print_r($numbers);

