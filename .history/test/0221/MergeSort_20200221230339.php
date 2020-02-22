<?php
/**
 * 归并排序 分区，分治，递归
 */
class MergeSort
{
    public static function sort(&$nums)
    {
        $count = count($nums);
        static::sortInterally($nums, 0, $count - 1);
    }

    public static function sortInterally(&$nums, $l, $r)
    {
        // 终止条件
        if ($l >= $r) return;
        $p = $l + (int) (($r - $l) / 2);

        static::sortInterally($nums, $l, $p);
        static::sortInterally($nums, $p + 1, $r);

        static::merge($nums, $l, $p, $r);
    }

    protected static function merge(&$nums, $l, $p, $r)
    {
        $i = $l;
        $j = $p + 1;

        $tmp = [];
        while ($i <= $p && $j <= $r) {
            if ($nums[$i] > $nums[$j]) {
                $tmp[] = $nums[$j];
                $j++;
            } else {
                $tmp[] = $nums[$i];
                $i++;
            }
        }

        // 右侧还有数据
        if ($j <= $r) {
            $i = $j;
            $p = $r;
        }
        while ($i <= $p) {
            $tmp[] = $nums[$i];
            $i++;
        }

        // 将数据拷贝回原始数据
        for ($i = 0; $i <= $r - $l; $i++) {
            $nums[$l + $i] = $tmp[$i];
        }
    }
}

$nums = [6, 7, 1, 3, 2, 5, 4];
MergeSort::sort($nums);
print_r($nums);
