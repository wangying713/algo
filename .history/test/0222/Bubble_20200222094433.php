<?php

function bubbleSort(&$nums)
{
    $count = count($nums);
    $lastBorder = 0;
    $borderSort = $count - 1;
    for ($i = 0; $i < $count; $i++) {

        $swap = false;
        for ($j = 0; $j < $borderSort; $j++) {
            if ($nums[$j] > $nums[$j + 1]) {
                $tmp = $nums[$j];
                $nums[$j] = $nums[$j + 1];
                $nums[$j + 1] = $tmp;

                $swap = true;
                $lastBorder = $j;
            }
        }

        if (!$swap) {
            break;
        }
    }
}

$nums = [6, 7, 1, 3, 2, 5, 4];
$rs = bubbleSort($nums);
print_r($nums);
