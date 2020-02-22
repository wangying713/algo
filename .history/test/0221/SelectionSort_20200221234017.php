<?php
/**
 * 选择排序
 *   分区，每次在未排序区间搜索最小的放到已排序区间的最右侧
 */
function selectionSort(&$nums)
{

}

$nums = [6, 7, 1, 3, 2, 5, 4];
$rs = selectionSort($nums);
print_r($rs);
