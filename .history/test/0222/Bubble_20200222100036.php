<?php
/**
 * 冒泡排序
 *  算法步骤：
 *      1. 相邻的元素比较，当满足大小关系的时候，交换位置。一次排序，至少有一个元素会出现在应该出现的位置
 *      2. 冒泡排序的操作是两个原子，比较和交换
 *  复杂度：
 *      1. 时间复杂度
 *          冒泡排序交换的次数为逆有序度，逆有序度=满有序度-有序度。满有序度为
 *
 *      2. 由于是原地排序时间复杂度位 O(1)
 *      3. 没有改变相同值的顺序，因此是稳定算法
 *
 *
 *
 *   优化：
 *      1. 当没有数据交换时，代表已经有序，则跳出循环
 *      2. 每次排序之后都会有临界点，范围定在循环指定临界点
 *
 * @param array $nums
 * @return void
 */
function bubbleSort(array &$nums)
{
    $count = count($nums);
    $lastBorder = 0;
    $borderSort = $count - 1;
    for ($i = 0; $i < $count; $i++) {

        $swap = false;
        for ($j = 0; $j < $borderSort; $j++) {
            if ($nums[$j] > $nums[$j + 1]) {
                $tmp = $nums[$j];
                $nums[$j] = $nums[$j + 1];
                $nums[$j + 1] = $tmp;

                $swap = true;
                $lastBorder = $j;
            }
        }

        if (!$swap) {
            break;
        }

        $borderSort = $lastBorder;
    }
}

$nums = [6, 7, 1, 3, 2, 5, 4];
$rs = bubbleSort($nums);
print_r($nums);
