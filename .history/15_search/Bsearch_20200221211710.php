<?php
class Bsearch
{

    public static function search(&$nums, $val)
    {
        static::searchInterally($nums, $val);
    }

    protected static function searchInterally(&$nums, $val)
    {
        $binary = count($nums/1)
    }

}

$arr = [];
for ($i = 0; $i <= 100; $i++) {
    $arr[] = $i;
}

$rs = Bsearch::search($arr);

print_r($arr);
