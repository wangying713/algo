<?php
/**
 * 参考王争老师的代码翻译
 */
function knapsack($weight, $w)
{
    $n = count($weight);

    for ($i = 0; $i < $n; $i++) {
        for ($j = 0; $j <= $w; $j++) {
            $status[$i][$j] = true;
        }
    }

    // 第一行的数据要特殊处理，可以利用哨兵优化
    $status[0][0] = true;

    // 如果第0个的总重量小于背包的重量，那么直接标记
    if ($weight[0] < $w) {
        $status[0][$weight[0]] = true;
    }

    for ($i = 1; $i < $n; $i++) {
        for ($j = 0; $j <= $w; $j++) {
            // 不把第i个物品放入背包
            if ($status[$i - 1][$j] == true) {
                // 如果上一行已经标记了，那么直接赋值
                $status[$i][$j] = $status[$i - 1][$j];
            }
        }

        // 把第i个物品放入背包
        for ($j = 0; $j <= $w - $weight[$i]; $j++) {
            if ($status[$i - 1][$j] == true) {
                $status[$i][$j + $weight[$i]] = true;
            }
        }
    }

    for ($i = $w; $i >= 0; $i--) {
        if ($status[$n - 1][$i] == true) {
            return $i;
        }
    }

    return 0;
}

$weight = [2, 2, 4, 6, 3];
$rs = knapsack($weight, 9);

var_dump($rs);
