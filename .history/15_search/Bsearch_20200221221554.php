<?php
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
     * Undocumented function
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
                $l = $bs + 1;
            } else {
                $l = $bs - 1;
            }
        }
        return -1;
    }

}

$arr = [];
for ($i = 0; $i <= 100; $i++) {
    $arr[] = $i;
}

$rs = Bsearch::search($arr, 5);

var_dump($rs);
