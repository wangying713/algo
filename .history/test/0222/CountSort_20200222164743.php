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

    $tmp = [];
    for ($i = $count - 1; $i >= 0; $i--) {
        // 计算新值的 key
        $index = $nums[$nums[$i]] - 1;
        // 放入指定的位置
        $tmp[$index] = $nums[$i];
    }

    // 将 tmp 赋值給原数组
    foreach ($tmp as $k => $val) {
        $nums[$k] = $val;
    }
}
$nums = [2, 5, 3, 0, 2, 3, 0, 3];
countSort($nums);
print_r($nums);
die;
