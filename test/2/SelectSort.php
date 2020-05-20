<?php
function selectSort(&$arr) {
    $len = count($arr);

    for($i=0; $i<$len; $i++) {

        $min = $i;
        for($j = $i+1; $j < $len; $j++) {
            if ($arr[$j] < $arr[$min]) {
                $min = $j;
            }
        }

        $tmp = $arr[$i];
        $arr[$i] = $arr[$min];
        $arr[$min] = $tmp;
    }
}
$nums = [6, 7, 1, 3, 2, 5, 4];
$rs = selectSort($nums);
print_r($nums);
