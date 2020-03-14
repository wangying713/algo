<?php
/**
 * 利用贪心算法求集合覆盖的问题，题目在Area.png 中
 *
 * 解题思路
 *  1. 利用贪心算法的核心思想，每次从未覆盖电台的集合中找到能覆盖电台最多的那一个，并且标记
 *  2. 重复1的操作，直到全部地区移出完成
 *
 */
$area = [
    'k1' => ["北京", "上海", "天津"],
    'k2' => ["广州", "北京", "深圳"],
    'k3' => ["成都", '上海', "杭州"],
    'k4' => ["上海", "天津"],
    'k5' => ["杭州", "大连"],
];

function getAllAreaUnique($area)
{
    $allArea = [];
    foreach ($area as $val) {
        foreach ($val as $v) {
            $allArea[] = $v;
        }
    }
    return array_unique($allArea);
}

function algo($area)
{
    $allArea = getAllAreaUnique($area);
    // 结果集
    $rs = [];
    while (count($allArea) > 0) {

        // 最大的重复个数
        $maxNum = 0;
        // 最大重复个数的索引
        $maxIndex = null;

        foreach ($area as $key => $val) {

            if ($val == null) {
                continue;
            }

            $tmp = 0;
            foreach ($val as $v) {
                if (false !== array_search($v, $allArea)) {
                    $tmp++;
                }
            }

            if ($tmp > $maxNum) {
                $maxNum = $tmp;
                $maxIndex = $key;
            }

            if ($maxIndex == null) {
                $maxIndex = $key;
            } else if ($tmp > count($val)) {
                $maxIndex = $key;
            }
        }
        // 移出数组
        foreach ($area[$maxIndex] as $val) {
            if (false !== ($index = array_search($val, $allArea))) {
                array_splice($allArea, $index, 1);
            }
        }
        $area[$maxIndex] = null;
        $rs[] = $maxIndex;
    }

    return $rs;
}

$rs = algo($area);
print_r($rs);
