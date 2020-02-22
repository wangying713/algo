<?php
/**
 * 基数排序
 *  排个位，十位，百位
 */
class RadixSort
{

}
$nums = [1, 99, 100, 8888, 9999, 947, 1, 2, 3, 4, 5, 6];
RadixSort::sort($nums);
print_r($nums);
