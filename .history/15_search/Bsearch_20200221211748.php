<?php
class Bsearch
{

    public static function search(&$nums, $val)
    {
        $count = count($nums);

        static::searchInterally($nums, $val);
    }

    protected static function searchInterally(&$nums, $l, $r)
    {

    }

}

$arr = [];
for ($i = 0; $i <= 100; $i++) {
    $arr[] = $i;
}

$rs = Bsearch::search($arr);

print_r($arr);
