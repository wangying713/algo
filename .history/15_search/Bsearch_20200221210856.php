<?php
class Bsearch
{

    public static function search()
    {

    }

}

$arr = [];
for ($i = 0; $i <= 100; $i++) {
    $arr[] = $i;
}

$rs = Bsearch::search();

print_r($arr);
