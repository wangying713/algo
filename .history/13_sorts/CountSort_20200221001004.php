<?php
/**
 * 基数排序
 * 利用桶排序的思想，分成颗粒
 */
function countSort(&$nums) {

    $count = count($nums);

    // 查找数组中的数据范围
    $max = max($nums);

    // 申请一个基数数组 c，下标大小[0, max]
    $c = [];
    for($i=0; $i<$max; $i+_) {
        $c[$i] = 0;
    }

    // 计算每个元素的个数，放入 c 中
    for($i=0; $i<$count; $i++) {
        $c[$nums[$i]] ++;
    }

    // 依次累加。第 n 个的值等于前 n 个数据的总和
    for($i=1; $i<=$max; $i++) {
        $c[$i] = $c[$i-1] + $c[$i];
    }

    // 临时排序好的数组
    $r = [];
    for($i=$count-1; $i>=0; $i--) {
        // nums中的value 当做 c 中的 key。 -1是为了放入新数组中当做 key
        $index = $c[$nums[$i]] - 1;
        $r
    }
}


$nums = [2, 5, 3, 0, 2, 3, 0, 3];