<?php
/**
 * 二分查找
 *  算法步骤
 *      1. 在一个数据中间获得一个基准值，比基准值大的，在基准值的右侧查找，比基准值小的，在基准值的左侧查找
 *      2. 采用递归+分治的思想
 *      3. 终止条件l>=p
 *
 *  时间时间复杂度
 *      平均时间复杂度：O(logn) ，一共需要查找 logn 层
 *  条件限制：
 *      1. 需要数组，使用数组下标
 *      2. 数据量太小没有发挥性能的优势
 *      3. 数据量太大对内存的连续性要求的又很高。因此也不适合二分查找
 */
class Bsearch
{

    public static function search($nums, $val)
    {
        $count = count($nums);
        return static::searchInterally($nums, 0, $count - 1, $val);
    }

    /**
     * 递归分治
     *
     * @param [array] $nums
     * @param [int] $l
     * @param [int] $r
     * @param [int] $val
     * @return void
     */
    protected static function searchInterally($nums, $l, $r, $val)
    {
        if ($l >= $r) {
            return -1;
        }
        $bs = $l + ceil(($r - $l) / 2);

        if ($val == $nums[$bs]) {
            return $bs;
        } else if ($val < $nums[$bs]) {
            return static::searchInterally($nums, $l, $bs - 1, $val);
        } else {
            return static::searchInterally($nums, $bs + 1, $r, $val);
        }
    }

    /**
     * 二分查找迭代方式
     *
     * @param array $nums
     * @param Int $val
     * @return void
     */
    public static function bsearchWhile(array $nums, Int $val)
    {
        $l = 0;
        $r = count($nums) - 1;
        while ($l <= $r) {
            $bs = $l + ceil(($r - $l) / 2);
            if ($val == $nums[$bs]) {
                return $bs;
            } else if ($val < $nums[$bs]) {
                $r = $bs - 1;
            } else {
                $l = $bs + 1;
            }
        }
        return -1;
    }

}

$arr = [];
for ($i = 0; $i <= 100; $i++) {
    $arr[] = $i;
}

$rs = Bsearch::bsearchWhile($arr, 5);

var_dump($rs);
