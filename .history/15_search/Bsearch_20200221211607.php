<?php
class Bsearch
{

    public static function search(&$nums, $val)
    {
        searchInterally($nums, $val)
    }

    protected static function searchInterally(&$nums, $val)
    {

    }

}

$arr = [];
for ($i = 0; $i <= 100; $i++) {
    $arr[] = $i;
}

$rs = Bsearch::search($arr);

print_r($arr);
