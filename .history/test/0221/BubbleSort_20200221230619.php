<?php
/**
 * 冒泡排序
 *  1. 相邻的元素比较，当满足大小关系的时候，交换位置。一次排序，至少有一个元素会出现在应该出现的位置
 *  2. 冒泡排序的操作是两个原子，比较和交换
 */
function bubbleSort(&$nums)
{

}

$nums = [6, 7, 1, 3, 2, 5, 4];
$rs = bubbleSort($nums);
print_r($nums);
