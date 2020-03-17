<?php

function getMax($arr)
{
    $product = $arr;
    // 计算单价
    foreach ($product as &$val) {
        $singlePrice = bcdiv($val['price'], $val['weight'], 2);
        $val['singlePrice'] = bcmul($singlePrice, 100, 0);
    }
    rsort($product);

    $total = 0;
    $result = [];
    foreach ($product as $val) {
        $max = 100 - $total;
        if ($max == 0) {
            break;
        }
        if ($val['weight'] < $max) {
            $max = $val['weight'];
        }
        $val['used'] = $max;
        $result[] = $val;
        $total += $max;
    }

    return $result;
}

$product = [
    [
        'singlePrice' => 0,
        'name' => '黄豆',
        'weight' => '100',
        'price' => '100',
    ],
    [
        'singlePrice' => 0,
        'name' => '绿豆',
        'weight' => '30',
        'price' => '90',
    ],
    [
        'singlePrice' => 0,
        'name' => '红豆',
        'weight' => '60',
        'price' => '120',
    ],
    [
        'singlePrice' => 0,
        'name' => '黑豆',
        'weight' => '20',
        'price' => '80',
    ],
    [
        'singlePrice' => 0,
        'name' => '青豆',
        'weight' => '50',
        'price' => '75',
    ],
];
$rs = getMax($product);

print_r($rs);
