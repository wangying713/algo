<?php
/**
 * 插入排序
 */
function insertionSort(&$nums)
{
    $count = count($nums);
    for ($i = 1; $i < $count; $i++) {
        $val = $nums[$i];
        for ($j = $i - 1; $j >= 0; $j--) {
            if ($nums[$j] > $val) {
                // 偏移
                $nums[$j + 1] = $nums[$j];
            } else {
                // 最大的都比不过，何况更小的
                break;
            }
        }
        $nums[$j + 1] = $val;
    }
}

$nums = [6, 7, 1, 3, 2, 5, 4];
$rs = insertionSort($nums);
print_r($nums);
