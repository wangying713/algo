<?php

/**
 * 冒泡排序
 * 
 * 比较相邻的两个元素，如果满足大小交换条件，那么就交换他们。一直到n-1个。
 * 重复以上操作。一直到交换结束。只有两个院子操作
 *
 * @param $nums
 */
function bubbling(&$nums)
{
    $count = count($nums);
    if ($count <= 1) return;
    for ($i = 0; $i < $count; $i++) {
        for ($j = 0; $j < $count - 1; $j++) {
            if ($nums[$j] > $nums[$j + 1]) {
                $tmp = $nums[$j];
                $nums[$j] = $nums[$j + 1];
                $nums[$j + 1] = $tmp;;
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
    if ($count <= 1) return;

    // 标志提前退出
    $flag = false;
    for ($i = 0; $i < $count; $i++) {
        for ($j = 0; $j < $count - 1; $j++) {
            if ($nums[$j] > $nums[$j + 1]) {
                $tmp = $nums[$j];
                $nums[$j] = $nums[$j + 1];
                $nums[$j + 1] = $tmp;;
                $flag = true;
            }
        }

        // 没有数据交换就提前退出
        if (!$flag) break;
    }
}


/**
 * 冒泡排序优化版
 */
function bubbling2(&$nums)
{
    $count = count($nums);
    if ($count <= 1) return;

    // 标志提前退出
    $flag = false;
    $lastExchange = 0;
    $sortBorder = $count - 1;
    for ($i = 0; $i < $count; $i++) {
        for ($j = 0; $j < $count - 1; $j++) {
            if ($nums[$j] > $nums[$j + 1]) {
                $tmp = $nums[$j];
                $nums[$j] = $nums[$j + 1];
                $nums[$j + 1] = $tmp;;
                $flag = true;
                $lastExchange = $j;
            }
        }
        $sortBorder = $j;

        // 没有数据交换就提前退出
        if (!$flag) break;
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
