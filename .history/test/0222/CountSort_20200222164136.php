<?php
/**
 * 计数排序
 */
function countSort(array &$nums)
{
    $count = count($nums);
    $max = max($nums);
    // 获得数组区间
    $c = [];
    for ($i = 0; $i <= $max; $i++) {
        $c[$i] = 0;
    }

    // 计数重复次数
    for ($i = 0; $i < $count; $i++) {
        $c[$nums[$i]]++;
    }

    // 计算总和
    for ($i = 1; $i <= $max; $i++) {
        $c[$i] = $c[$i - 1] + $c[$i];
    }

    // 计算取值
    for ($i = $count - 1; $i >= 0; $i--) {

        // 获取 c 的值，放入指定的位置
        $key = $nums[$nums[$i]] - 1;
    }

}
