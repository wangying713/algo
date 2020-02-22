<?php
/**
 * 选择排序
 *  算法步骤：
 *      1. 与插入排序类似，分为已排序分区和未排序分区
 *      2. 每次从未排序分区中获得最小的元素，放到已排序分区最后的位置
 *      3. 持续2的操作，一直到未排序分区的元素未空
 *
 *   选择排序的复杂度
 *      最好
 */
function selectSort(&$nums)
{
    $count = count($nums);
    $tmp = [];
    for ($i = 0; $i < $count; $i++) {

        $min = $nums[$i];
        for ($j = $i; $i < $count; $j++) {
            if ($min < $nums[$j]) {
                $min = $nums[$j];
            }
        }
        $tmp[] = $min;
    }

    $nums = [6, 7, 1, 3, 2, 5, 4];
    $rs = selectionSort($nums);
    print_r($rs);

}
