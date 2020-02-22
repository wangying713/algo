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
        $c[$a[$i]] ++;
    }

}


$nums = [2, 5, 3, 0, 2, 3, 0, 3];