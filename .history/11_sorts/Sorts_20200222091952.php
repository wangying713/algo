<?php
/**
 * 冒泡排序
 *  算法步骤：
 *      1. 相邻的元素比较，当满足大小关系的时候，交换位置。一次排序，至少有一个元素会出现在应该出现的位置
 *      2. 冒泡排序的操作是两个原子，比较和交换
 *  复杂度：
 *      1. 时间复杂度O(n2)
 *      2. 由于是原地排序时间复杂度位 O(1)
 *      3. 没有改变相同值的顺序，因此是稳定算法
 *
 *   优化：
 *      1. 当没有数据交换时，代表已经有序，则跳出循环
 *      2. 每次排序之后都会有临界点，范围定在循环指定临界点
 *
 */

function bubbling(&$nums)
{
    $count = count($nums);
    if ($count <= 1) {
        return;
    }

    for ($i = 0; $i < $count; $i++) {
        for ($j = 0; $j < $count - 1; $j++) {
            if ($nums[$j] > $nums[$j + 1]) {
                $tmp = $nums[$j];
                $nums[$j] = $nums[$j + 1];
                $nums[$j + 1] = $tmp;
            }
        }
    }
}

/**
 * 冒泡排序优化版
 */
function bubbling1(&$nums)
{
    $count = count($nums);
    if ($count <= 1) {
        return;
    }

    // 标志提前退出
    $flag = false;
    for ($i = 0; $i < $count; $i++) {
        for ($j = 0; $j < $count - 1; $j++) {
            if ($nums[$j] > $nums[$j + 1]) {
                $tmp = $nums[$j];
                $nums[$j] = $nums[$j + 1];
                $nums[$j + 1] = $tmp;
                $flag = true;
            }
        }

        // 没有数据交换就提前退出
        if (!$flag) {
            break;
        }

    }
}

/**
 * 冒泡排序优化版
 */
function bubbling2(&$nums)
{
    $count = count($nums);
    if ($count <= 1) {
        return;
    }

    // 标志提前退出
    $flag = false;
    $lastExchange = 0;
    $sortBorder = $count - 1;
    for ($i = 0; $i < $count; $i++) {
        for ($j = 0; $j < $count - 1; $j++) {
            if ($nums[$j] > $nums[$j + 1]) {
                $tmp = $nums[$j];
                $nums[$j] = $nums[$j + 1];
                $nums[$j + 1] = $tmp;
                $flag = true;
                $lastExchange = $j;
            }
        }
        $sortBorder = $j;

        // 没有数据交换就提前退出
        if (!$flag) {
            break;
        }

    }
}

/**
 * 分区，有序区与无序区，从无序区拿数据放入有序区
 *
 * 插入排序
 */
function insertion(&$nums)
{
    $count = count($nums);
    for ($i = 1; $i < $count; $i++) {

        $val = $nums[$i];

        $j = $i - 1;
        for ($j = $i - 1; $j >= 0; $j--) {
            if ($nums[$j] > $val) {
                $nums[$j + 1] = $nums[$j];
            } else {
                break;
            }
        }
        $nums[$j + 1] = $val;
    }
}

/**
 * 选择排序
 *   分区，已拍序区间与未排序区间
 *   每次寻找未排序区间，放到已排序区间的末尾
 *
 */
function selectionSort(&$nums)
{

    $count = count($nums);

    for ($i = 0; $i < $count; $i++) {

        $minIndex = $i;
        for ($j = $i; $j < $count; $j++) {
            if ($nums[$j] < $nums[$minIndex]) {
                $minIndex = $j;
            }
        }
        // 替换
        $tmp = $nums[$i];
        $nums[$i] = $nums[$minIndex];
        $nums[$minIndex] = $tmp;
    }
}

$arr = [4, 5, 6, 1, 3, 2, 7];

selectionSort($arr);

print_r($arr);
die;
