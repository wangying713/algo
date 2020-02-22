<?php
/**
 * 二分查找的变体三
 *  查找第一个大于等于给定值的元素
 *
 * 说明
 *  [3, 4, 6, 7, 10] 要查找第一个大于等于5的元素，下标是6
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
        $bs = $l + (int) (($r - $l) / 2);

        if ($nums[$bs] >= $val) {
            if ($bs == 0 || ($nums[$bs - 1] < $val)) {
                return $bs;
            }
            $r = $bs - 1;
        } else {
            $l = $bs + 1;
        }
        return static::searchInterally($nums, $l, $r, $val);
    }
}

$nums = [3, 4, 6, 7, 10];
$rs = Bsearch::search($nums, 5);

var_dump($rs);
