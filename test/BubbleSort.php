<?php
/**
 * 冒泡排序，相邻元素比较
 */
function bubbleSort(&$nums)
{
    $count = count($nums);

    // 最后一次交换的未知
    $lastExchange = 0;
    // 边界
    $borderSrot = $count - 1;
    for ($i = 0; $i < $count; $i++) {

        $val = $nums[$i];
        // 提前退出标志
        $flag = false;
        for ($j = 0; $j < $borderSrot; $j++) {
            if ($nums[$j] > $nums[$j + 1]) {
                $tmp = $nums[$j];
                $nums[$j] = $nums[$j + 1];
                $nums[$j + 1] = $tmp;
                // 标记数据有被交换过
                $flag = true;
                $lastExchange = $j;
            }
        }

        // 如果没有数据交换，退出
        if (!$flag) break;
        $borderSrot = $lastExchange;
    }
}

$nums = [6, 7, 1, 3, 2, 5, 4];
$rs = bubbleSort($nums);
print_r($nums);
