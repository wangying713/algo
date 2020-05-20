<?php
function bucketSort(&$arr, $size) {

    $len = count($arr);

    $min = min($arr);
    // 将数据放入到桶内
    $buckets = [];
    for($i=0; $i<$len; $i++) {
        $key = (int) (($arr[$i] - $min) / $size);
        $buckets[$key][] = $arr[$i];
    }

    $k = 0;
    for ($i = 0; $i < count($buckets); $i++) {

        if (! isset($buckets[$i])) continue;

        // 对每个桶内的数据进行排序
        sort($buckets[$i]);
        foreach ($buckets[$i] as $val) {
            $nums[$k++] = $val;
        }
    }
}


$numbers = [15, 16, 17, 18, 19, 7, 8, 9, 10, 11, 1, 2, 3, 4, 5, 6, 12, 13, 14, 20, 80, 111];
$size = 10;
$rs = bucketSort($numbers, 4); //加载了quickSort文件，请忽略前几个打印

print_r($numbers);
