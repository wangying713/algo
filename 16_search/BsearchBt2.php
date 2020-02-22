<?php
/**
 * 二分查找的变体二
 *  查找最后一个值等于给定值的元素
 *
 * 说明
 *  [1, 3, 4, 5, 6, 8, 8, 8, 11, 18] 要查找第一个等于8的元素，下标是7
 */
class Bsearch
{

    public static function search(array &$nums, $val)
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
    protected static function searchInterally(array &$nums, $l, $r, $val)
    {
        if ($l >= $r) {
            return -1;
        }
        $bs = $l + ceil(($r - $l) / 2);

        if ($val < $nums[$bs]) {
            $r = $bs - 1;
        } else {
            // 前一个得值不等于这个值
            if ($val == $nums[$bs]) {
                if ($val != $nums[$bs + 1] || $bs == $r) {
                    return $bs;
                }

            }

            $l = $bs + 1;
        }
        return static::searchInterally($nums, $l, $r, $val);
    }
}

$nums = [1, 3, 4, 5, 6, 8, 8, 8, 11, 18];
$rs = Bsearch::search($nums, 8);

var_dump($rs);
