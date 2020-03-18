<?php
/**
 * 个人理解写的背包问题
 */
function knapsack($weight, $w)
{
    $n = count($weight);

    // 生成网格 weight*w
    $table = [];
    for ($j = 0; $j <= $w; $j++) {
        $table[$j] = 0;
    }

    $table[0] = true;
    if ($table[0] <= $w) {
        $table[$weight[0]] = true;
    }

    // 从第一行第一列开始遍历
    for ($i = 1; $i < $n; $i++) {
        for ($j = $w - $weight[$i]; $j > 0; $j--) {

            echo sprintf("i=%s, j=%s\n", $i, $j);
            print_r($table);
            if ($table[$j] == true) {
                $table[$j + $weight[$i]] = true;
            }
        }
    }

    for ($i = $w; $i >= 0; $i--) {
        if ($table[$i] == true) {
            return $i;
            die;
        }
    }
}
$weight = [8, 2, 4, 6, 3];
$rs = knapsack($weight, 9);

echo $rs . "\n";
