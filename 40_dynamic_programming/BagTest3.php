<?php
/**
 * 自己理解背包问题增加价值的背包问题
 */
class Bag
{
    public function test($arr, $capacity = 4)
    {
        $table = [];
        for ($i = 0; $i <= $capacity; $i++) {
            $table[-1][$i] = 0;
        }

        // for ($i = 0; $i < count($arr); $i++) {
        //     $table[$i][0] = 0;
        // }

        for ($i = 0; $i < count($arr); $i++) {
            // j代表质量
            for ($j = 1; $j <= $capacity; $j++) {
                if ($j >= $arr[$i]['weight']) {
                    // 当前商品的价值
                    $currentPrice = $arr[$i]['price'];
                    // 还剩下的容量
                    $tmpWeight = $j - $arr[$i]['weight'];
                    // 去上一行中获得还剩下的容量（$tmp）中的价值
                    $prevPrice = $table[$i - 1][$tmpWeight];
                    // 比较当前商品的价值+所剩容量商品的价值，与上一行商品最大价值取最大的
                    $table[$i][$j] = max($table[$i - 1][$j], $currentPrice + $prevPrice);
                } else {
                    $table[$i][$j] = $table[$i - 1][$j];
                }
            }
        }

        return $table[count($arr) - 1][$capacity];
    }

    function print($arr) {
        foreach ($arr as $value) {
            foreach ($value as $val) {
                echo $val . " ";
            }
            echo "\n";
        }
    }
}

$w = [
    ['name' => '吉他', 'weight' => 1, 'price' => 1500],
    ['name' => '音响', 'weight' => 4, 'price' => 3000],
    ['name' => '电脑', 'weight' => 3, 'price' => 2000],
];

$rs = new Bag();
$res = $rs->test($w);

var_dump($res);
