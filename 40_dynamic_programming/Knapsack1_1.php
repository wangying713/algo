<?php
/**
 * 个人理解写的背包问题
 */
function knapsack($weight, $w)
{
    $n = count($weight);

    // 生成网格 weight*w
    $table = [];
    for ($i = 0; $i <= $n; $i++) {
        for ($j = 0; $j <= $w; $j++) {
            $table[$i][$j] = 0;
        }
    }

    // 从第一行第一列开始遍历
    for ($i = 1; $i <= $n; $i++) {
        for ($j = 1; $j <= $w; $j++) {
            // 当前物品的重量
            $curWeight = $weight[$i - 1];
            // 如果当前物品的重量小于等于背包的容量
            if ($curWeight <= $j) {
                $total = $curWeight + ($j - $curWeight);
                if ($total > $table[$i - 1][$j]) {
                    $table[$i][$j] = 1;
                }
            }
        }
    }

    printTable($table, $weight);

}

function printTable($table, $weight)
{
    $i = count($table) - 1;
    $j = count($table[0]) - 1;

    $total = 0;
    while ($i >= 0 && $j >= 0) {
        if ($table[$i][$j] == 1) {
            echo sprintf("将第%s个物品加入背包，重量是%s\n", $i, $weight[$i - 1]);
            $j -= $weight[$i - 1];
            $total += $weight[$i - 1];
        }
        $i--;
    }

    echo sprintf("合计装入背包物品的重量是 %s \n", $total);
}

$weight = [2, 2, 4, 6, 3];
$rs = knapsack($weight, 9);
