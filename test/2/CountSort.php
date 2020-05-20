<?php
/**
 * 计数排序 通过计算得到新的数组 c，nums[i]为c数组的key。新数组的key-1为新数tmp据的key
 *  算法步骤
 *      1. 计算获得 nums 的最大值max
 *      2. 循环生成一个长度为max 的数组c
 *      3. 计算 nums 数组在 c 中出现的次数
 *      4. 计算 c 数组中前 n 项的重复次数总和 c[i] = c[i-1] + c[i]
 *      5. 在 c 中获得值当做 key，作为新数组 tmp 的值
 *      6. 拷贝 tmp 到 nums 中
 *  应用场景
 *      计数排序只能用在数据范围不大的场景中，如果数据范围 k 比要排序的数据 n 大很多，就不适合用计数排序了。
 *      而且，计数排序只能给非负整数排序，如果要排序的数据是其他类型的，要将其在不改变相对大小的情况下，转化为非负整数。
 */
function countSort(array &$nums)
{
    $len = count($nums);

    // 1. 生成数数组
    $maxLen = max($nums);
    $c = array_fill(0, $maxLen + 1, 0);
    for($i=0; $i<$len; $i++) {
        $index = $nums[$i];
        $c[$index] ++;
    }

    // 求和
    for($i=1; $i<=$maxLen; $i++) {
        $c[$i] = $c[$i-1] + $c[$i];
    }

    $tmp = [];
    for($i=$len-1; $i>=0; $i--) {
        $key = $nums[$i];
        $tmp[$c[$key] - 1] = $nums[$i];
        // 更新重复次数
        $c[$key] -- ;
    }       

    for ($i=0; $i<$len; $i++) {
        $nums[$i] = $tmp[$i];
    }

}

$nums = [2, 5, 3, 0, 2, 3, 0, 3];
countSort($nums);
print_r($nums);
die;
