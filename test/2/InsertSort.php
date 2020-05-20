<?php
function insertSort(&$arr) {

    $len = count($arr);

    for($i=1; $i<$len; $i++) {

        $tmp = $arr[$i];
        for ($j = $i-1; $j>=0; $j--) {
            if ($arr[$j] > $tmp) {
                $arr[$j+1] = $arr[$j];
            } else {
                break;
            }
        }
       
        // 条件满足，一定会空出来一个重复的位置为$j+1
        $arr[$j + 1] =$tmp;
    }
}

$nums = [5, 8, 3, 1];
$rs = insertSort($nums);
print_r($nums);