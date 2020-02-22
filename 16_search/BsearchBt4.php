<?php
/**
 * 二分查找的变体三
 *  查找最后一个小于等于给定值的元素
 *
 * 说明
 *  3，5，6，8，9，10。最后一个小于等于 7 的元素就是 6
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

        if ($nums[$bs] > $val) {
            $r = $bs - 1;
        } else {
            if ($bs == $r || ($nums[$bs - 1] < $val)) {
                return $bs;
            }

            $l = $bs + 1;
        }
        return static::searchInterally($nums, $l, $r, $val);
    }
}

$nums = [3, 5, 6, 8, 9, 10];
$rs = Bsearch::search($nums, 7);

var_dump($rs);
