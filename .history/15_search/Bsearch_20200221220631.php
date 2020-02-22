<?php
class Bsearch
{
    public static function search($nums, $val)
    {
        $count = count($nums);
        return static::searchInterally($nums, 0, $count - 1, $val);
    }

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
            return static::searchInterally($nums, $l, $bs - 1, $val);
        }

        return static::searchInterally($nums, $l, $bs - 1, $val);

    }
}

$arr = [];
for ($i = 0; $i <= 100; $i++) {
    $arr[] = $i;
}

$rs = Bsearch::search($arr, 5);

var_dump($rs);
