<?php

function bubbleSort(&$nums)
{

    $count = count($nums);
    for ($i = 0; $i < $count; $i++) {

        for ($j = 0; $j < $count; $j++) {
            if ($nums[$j] > $nums[$j + 1]) {
                $tmp = $nums[$j];
                $nums[$j] = $nums[$j + 1];
                $nums[$j + 1] = $tmp;
            }
        }

    }

}

$nums = [6, 7, 1, 3, 2, 5, 4];
$rs = bubbleSort($nums);
print_r($nums);
