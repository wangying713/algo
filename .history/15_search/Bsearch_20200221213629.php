<?php
class Bsearch
{

    public static function search(&$nums, $val)
    {
        $count = count($nums);
        static::searchInterally($nums, 0, $count - 1, $val);
    }

    protected static function searchInterally(&$nums, $l, $r, $val)
    {
        if ($l >= $r) {
            return -1;
        }

        $bs = $l + ceil(($r - $l) / 2);

        if ($val < $nums[$bs]) {
            static::searchInterally($nums, $l, $bs);
        } else if ($val > $nums[$bs]) {
            static::searchInterally($nums, $bs, $r);
        } else {
            return $bs;
        }
    }

}

$arr = [];
for ($i = 0; $i <= 100; $i++) {
    $arr[] = $i;
}

$rs = Bsearch::search($arr);

print_r($arr);
