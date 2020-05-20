<?php
// 相邻得两个元素比较大小，如果满足大小关系则交换他们
// 最好：o(n)， 最坏 o(n2), 平均 o(n2)

// 冒泡排序交换的次数为逆有序度，逆有序度=满有序度-有序度。满有序度为 n*(n-1)/2。
// 当一组数据的有序度为0，逆有序度就等于n*(n-1)/2。取平均值就是 n*(n-1)/4。比较次数一定比交换次数多。上限还是 O(n2)

function bubbleSort(&$arr) {
    $length = count($arr);
    $lastBorder = 0;
    $borderSort = $length - 1;
    for ($i=0; $i<$length; $i++) {
        // 标记交换
        $flagSwap = false;
        for ($j=0; $j<$borderSort; $j++) {
            if ($arr[$j] > $arr[$j+1]) {
                $tmp = $arr[$j];
                $arr[$j] = $arr[$j+1];
                $arr[$j+1] = $tmp;

                $flagSwap = true;

                $lastBorder = $j;
            }
        }

        if ($flagSwap == false) {
            break;
        }

        $borderSort = $lastBorder;
    }
}

$arr = [6,5,4,3,2,1];
bubbleSort($arr);

print_r($arr);
