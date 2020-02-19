<?php
/**
 * 选择排序
 *   分区，每次在未排序区间搜索最小的放到已排序区间的最右侧
 */
function selectionSort(&$nums)
{
    $count = count($nums);
    for ($i = 0; $i < $count; $i++) {
        $minIndex = $i;
        for ($j = $minIndex; $j < $count; $j++) {
            if ($nums[$j] < $nums[$minIndex]) {
                $minIndex = $j;
            }
        }
        // 将最小的放入 tmp
        $tmp = $nums[$i];
        $nums[$i] = $nums[$minIndex];
        $nums[$minIndex] = $tmp;
    }
}

$nums = [6, 7, 1, 3, 2, 5, 4];
$rs = selectionSort($nums);
print_r($rs);
